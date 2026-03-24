<?php
header('Content-Type: application/json; charset=utf-8');

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'config', 'connection.php']);

if (!$con || mysqli_connect_errno()) {
    http_response_code(500);
    echo json_encode(['statusCode' => 500, 'message' => 'Database connection failed']);
    exit;
}

$action = isset($_POST['action']) ? trim((string) $_POST['action']) : '';
if ($action !== 'updateblog') {
    echo json_encode(['statusCode' => 400, 'message' => 'Invalid request']);
    exit;
}

$blogId = isset($_POST['blogid']) ? trim((string) $_POST['blogid']) : '';
if ($blogId === '') {
    echo json_encode(['statusCode' => 400, 'message' => 'Invalid blog id']);
    exit;
}

$title = isset($_POST['blogtitle']) ? (string) $_POST['blogtitle'] : '';
$subtitle = isset($_POST['blogsubtitle']) ? (string) $_POST['blogsubtitle'] : '';
$shortdescription = isset($_POST['shortdescriptionadd']) ? (string) $_POST['shortdescriptionadd'] : '';
$fulldescription = isset($_POST['fulldescriptionadd']) ? (string) $_POST['fulldescriptionadd'] : '';

$uploadBase = implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'uploads']);
$ds = DIRECTORY_SEPARATOR;
if (!is_dir($uploadBase)) {
    mkdir($uploadBase, 0777, true);
}
if (!is_writable($uploadBase)) {
    @chmod($uploadBase, 0777);
}
if (!is_writable($uploadBase)) {
    http_response_code(500);
    echo json_encode(['statusCode' => 500, 'message' => 'Uploads folder is not writable']);
    exit;
}

// Fetch existing row so we can keep old images if user doesn't upload new ones.
$fetchSql = "SELECT id, thumbimages, innerimages FROM tblblog WHERE encrytiduniq = ? OR id = ? LIMIT 1";
$fetchStmt = mysqli_prepare($con, $fetchSql);
if (!$fetchStmt) {
    http_response_code(500);
    echo json_encode(['statusCode' => 500, 'message' => 'Database error']);
    exit;
}

mysqli_stmt_bind_param($fetchStmt, 'ss', $blogId, $blogId);
mysqli_stmt_execute($fetchStmt);
mysqli_stmt_bind_result($fetchStmt, $currentId, $oldThumb, $oldInner);
$hasRow = mysqli_stmt_fetch($fetchStmt);
mysqli_stmt_close($fetchStmt);

if (!$hasRow) {
    echo json_encode(['statusCode' => 404, 'message' => 'Blog not found']);
    exit;
}

$thumbimagesToSave = $oldThumb;
$innerimagesToSave = $oldInner;

// Replace thumbnail only if a new file is uploaded.
if (isset($_FILES['thumbimageadd']) && $_FILES['thumbimageadd']['error'] === UPLOAD_ERR_OK && is_uploaded_file($_FILES['thumbimageadd']['tmp_name'])) {
    $thumbExt = pathinfo($_FILES['thumbimageadd']['name'], PATHINFO_EXTENSION);
    $thumbExt = strtolower((string) $thumbExt);
    $thumbFileName = uniqid('t_', true) . ($thumbExt !== '' ? '.' . $thumbExt : '');
    $thumbDest = $uploadBase . $ds . $thumbFileName;

    if (!move_uploaded_file($_FILES['thumbimageadd']['tmp_name'], $thumbDest)) {
        http_response_code(400);
        echo json_encode(['statusCode' => 400, 'message' => 'Thumbnail image upload failed']);
        exit;
    }

    // Delete old thumb if it exists and differs.
    if (!empty($oldThumb) && $oldThumb !== $thumbFileName) {
        $oldThumbPath = $uploadBase . $ds . $oldThumb;
        if (file_exists($oldThumbPath)) {
            @unlink($oldThumbPath);
        }
    }

    $thumbimagesToSave = $thumbFileName;
}

// Replace inner image only if a new file is uploaded.
if (isset($_FILES['innerimageadd']) && $_FILES['innerimageadd']['error'] === UPLOAD_ERR_OK && is_uploaded_file($_FILES['innerimageadd']['tmp_name'])) {
    $innerExt = pathinfo($_FILES['innerimageadd']['name'], PATHINFO_EXTENSION);
    $innerExt = strtolower((string) $innerExt);
    $innerFileName = uniqid('i_', true) . ($innerExt !== '' ? '.' . $innerExt : '');
    $innerDest = $uploadBase . $ds . $innerFileName;

    if (!move_uploaded_file($_FILES['innerimageadd']['tmp_name'], $innerDest)) {
        // If thumb was just replaced, keep DB not updated by exiting early.
        http_response_code(400);
        echo json_encode(['statusCode' => 400, 'message' => 'Inner image upload failed']);
        exit;
    }

    if (!empty($oldInner) && $oldInner !== $innerFileName) {
        $oldInnerPath = $uploadBase . $ds . $oldInner;
        if (file_exists($oldInnerPath)) {
            @unlink($oldInnerPath);
        }
    }

    $innerimagesToSave = $innerFileName;
}

$updateSql = "UPDATE tblblog SET thumbimages = ?, title = ?, subtitle = ?, shortdescription = ?, innerimages = ?, fulldescription = ? WHERE id = ?";
$updateStmt = mysqli_prepare($con, $updateSql);
if (!$updateStmt) {
    http_response_code(500);
    echo json_encode(['statusCode' => 500, 'message' => 'Database error']);
    exit;
}

mysqli_stmt_bind_param(
    $updateStmt,
    'ssssssi',
    $thumbimagesToSave,
    $title,
    $subtitle,
    $shortdescription,
    $innerimagesToSave,
    $fulldescription,
    $currentId
);

if (!mysqli_stmt_execute($updateStmt)) {
    http_response_code(400);
    echo json_encode(['statusCode' => 400, 'message' => 'Failed to update blog']);
    mysqli_stmt_close($updateStmt);
    exit;
}

mysqli_stmt_close($updateStmt);
echo json_encode(['statusCode' => 200, 'message' => 'Blog updated successfully']);
?>
