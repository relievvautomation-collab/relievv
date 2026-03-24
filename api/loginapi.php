<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'config', 'connection.php']);

if (!$con || mysqli_connect_errno()) {
    http_response_code(500);
    echo json_encode(['statusCode' => 500, 'message' => 'Database connection failed']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || $_POST['action'] !== 'login') {
    echo json_encode(['statusCode' => 400, 'message' => 'Invalid request']);
    exit;
}

$email = isset($_POST['adminemail']) ? trim((string) $_POST['adminemail']) : '';
$password = isset($_POST['adminpassword']) ? (string) $_POST['adminpassword'] : '';

if ($email === '' || $password === '') {
    echo json_encode(['statusCode' => 400, 'message' => 'Please enter your email and password']);
    exit;
}

$sql = 'SELECT id, email, password FROM tbladmin WHERE email = ? LIMIT 1';
$stmt = mysqli_prepare($con, $sql);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['statusCode' => 500, 'message' => 'Login not configured. Check tbladmin (id, email, password).']);
    exit;
}

mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = $result ? mysqli_fetch_assoc($result) : null;
mysqli_stmt_close($stmt);

if (!$row) {
    echo json_encode(['statusCode' => 400, 'message' => 'Invalid email or password']);
    exit;
}

$stored = (string) $row['password'];
$valid = false;
if ($stored !== '' && (strpos($stored, '$2y$') === 0 || strpos($stored, '$2a$') === 0 || strpos($stored, '$2b$') === 0)) {
    $valid = password_verify($password, $stored);
} else {
    $valid = hash_equals($stored, $password);
}

if (!$valid) {
    echo json_encode(['statusCode' => 400, 'message' => 'Invalid email or password']);
    exit;
}

$_SESSION['admin_id'] = (int) $row['id'];
$_SESSION['adminemail'] = $email;
$_SESSION['admin__login'] = '1';

echo json_encode([
    'statusCode' => 200,
    'message' => 'Login successful',
    'redirecturl' => 'addblog',
]);
