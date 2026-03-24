<?php
header('Content-Type: application/json; charset=utf-8');

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'config', 'connection.php']);

if (!$con || mysqli_connect_errno()) {
    http_response_code(500);
    echo json_encode(['statusCode' => 500, 'message' => 'Database connection failed']);
    exit;
}

if (!isset($_POST['action']) || $_POST['action'] !== 'addblog') {
    echo json_encode(['statusCode' => 400, 'message' => 'Invalid request']);
    exit;
}

$title = isset($_POST['blogtitle']) ? $_POST['blogtitle'] : '';
$subtitle = isset($_POST['blogsubtitle']) ? $_POST['blogsubtitle'] : '';
$shortdescription = isset($_POST['shortdescriptionadd']) ? $_POST['shortdescriptionadd'] : '';
$fulldescription = isset($_POST['fulldescriptionadd']) ? $_POST['fulldescriptionadd'] : '';

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

$thumbimages = '';
if (!empty($_FILES['thumbimageadd']['tmp_name']) && is_uploaded_file($_FILES['thumbimageadd']['tmp_name'])) {
    $ext = pathinfo($_FILES['thumbimageadd']['name'], PATHINFO_EXTENSION);
    $thumbFileName = uniqid('t_', true) . ($ext !== '' ? '.' . $ext : '');
    $thumbDest = $uploadBase . $ds . $thumbFileName;
    if (!move_uploaded_file($_FILES['thumbimageadd']['tmp_name'], $thumbDest)) {
        http_response_code(400);
        echo json_encode(['statusCode' => 400, 'message' => 'Thumbnail image upload failed']);
        exit;
    }
    $thumbimages = $thumbFileName;
} elseif (isset($_FILES['thumbimageadd']) && $_FILES['thumbimageadd']['error'] !== UPLOAD_ERR_NO_FILE) {
    http_response_code(400);
    echo json_encode(['statusCode' => 400, 'message' => 'Thumbnail image upload failed']);
    exit;
}

$innerimages = '';
if (!empty($_FILES['innerimageadd']['tmp_name']) && is_uploaded_file($_FILES['innerimageadd']['tmp_name'])) {
    $ext = pathinfo($_FILES['innerimageadd']['name'], PATHINFO_EXTENSION);
    $innerFileName = uniqid('i_', true) . ($ext !== '' ? '.' . $ext : '');
    $innerDest = $uploadBase . $ds . $innerFileName;
    if (!move_uploaded_file($_FILES['innerimageadd']['tmp_name'], $innerDest)) {
        if ($thumbimages !== '') {
            @unlink($uploadBase . $ds . $thumbimages);
        }
        http_response_code(400);
        echo json_encode(['statusCode' => 400, 'message' => 'Inner image upload failed']);
        exit;
    }
    $innerimages = $innerFileName;
} elseif (isset($_FILES['innerimageadd']) && $_FILES['innerimageadd']['error'] !== UPLOAD_ERR_NO_FILE) {
    if ($thumbimages !== '') {
        @unlink($uploadBase . $ds . $thumbimages);
    }
    http_response_code(400);
    echo json_encode(['statusCode' => 400, 'message' => 'Inner image upload failed']);
    exit;
}

$encrytiduniq = function_exists('random_bytes')
    ? bin2hex(random_bytes(16))
    : md5(uniqid((string) mt_rand(), true));

$sql = 'INSERT INTO tblblog (thumbimages, title, subtitle, shortdescription, innerimages, fulldescription, created_at, encrytiduniq) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)';
$stmt = mysqli_prepare($con, $sql);
if (!$stmt) {
    if ($thumbimages !== '') {
        @unlink($uploadBase . $ds . $thumbimages);
    }
    if ($innerimages !== '') {
        @unlink($uploadBase . $ds . $innerimages);
    }
    error_log('addblog prepare: ' . mysqli_error($con));
    echo json_encode(['statusCode' => 500, 'message' => 'Database error']);
    exit;
}

mysqli_stmt_bind_param($stmt, 'sssssss', $thumbimages, $title, $subtitle, $shortdescription, $innerimages, $fulldescription, $encrytiduniq);

if (!mysqli_stmt_execute($stmt)) {
    if ($thumbimages !== '') {
        @unlink($uploadBase . $ds . $thumbimages);
    }
    if ($innerimages !== '') {
        @unlink($uploadBase . $ds . $innerimages);
    }
    error_log('addblog execute: ' . mysqli_stmt_error($stmt));
    echo json_encode(['statusCode' => 400, 'message' => 'Failed to add blog']);
    exit;
}

mysqli_stmt_close($stmt);
echo json_encode(['statusCode' => 200, 'message' => 'Blog added successfully']);
