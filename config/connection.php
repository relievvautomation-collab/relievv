 <?php
// // Local XAMPP defaults; Coolify/Docker: set DB_HOST, DB_USER, DB_PASSWORD, DB_NAME in environment
// $dbhost = getenv('DB_HOST') ?: 'localhost';
// $dbuser = getenv('DB_USER') ?: 'root';
// $dbpassword = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '';
// $dbname = getenv('DB_NAME') ?: 'relievv';
// $con = mysqli_connect($dbhost , $dbuser , $dbpassword ,$dbname);
// if(!$con){
//     echo "Connection failed: " . mysqli_connect_error();
// }
// ?>




<?php
// Supports both discrete env vars and URL-style vars from platforms like Coolify.
$dbUrl = getenv('DATABASE_URL');
if ($dbUrl === false || $dbUrl === '') {
    $dbUrl = getenv('MYSQL_URL');
}
if ($dbUrl === false || $dbUrl === '') {
    $dbUrl = getenv('DB_URL');
}

$urlParts = false;
if ($dbUrl !== false && $dbUrl !== '') {
    $urlParts = parse_url($dbUrl);
    if ($urlParts !== false && isset($urlParts['path'])) {
        $urlParts['path'] = ltrim($urlParts['path'], '/');
    }
}

$dbhost = getenv('DB_HOST');
if ($dbhost === false || $dbhost === '') {
    $dbhost = getenv('MYSQL_HOST');
}
if (($dbhost === false || $dbhost === '') && $urlParts !== false && isset($urlParts['host'])) {
    $dbhost = $urlParts['host'];
}
if ($dbhost === false || $dbhost === '') {
    $dbhost = 'localhost';
}

$dbuser = getenv('DB_USER');
if ($dbuser === false || $dbuser === '') {
    $dbuser = getenv('MYSQL_USER');
}
if (($dbuser === false || $dbuser === '') && $urlParts !== false && isset($urlParts['user'])) {
    $dbuser = $urlParts['user'];
}
if ($dbuser === false || $dbuser === '') {
    $dbuser = 'root';
}

$dbpassword = getenv('DB_PASSWORD');
if ($dbpassword === false) {
    $dbpassword = getenv('DB_PASS');
}
if ($dbpassword === false) {
    $dbpassword = getenv('MYSQL_PASSWORD');
}
if (($dbpassword === false || $dbpassword === '') && $urlParts !== false && isset($urlParts['pass'])) {
    $dbpassword = $urlParts['pass'];
}
if ($dbpassword === false) {
    $dbpassword = '';
}

$dbname = getenv('DB_NAME');
if ($dbname === false || $dbname === '') {
    $dbname = getenv('MYSQL_DATABASE');
}
if (($dbname === false || $dbname === '') && $urlParts !== false && !empty($urlParts['path'])) {
    $dbname = $urlParts['path'];
}
if ($dbname === false || $dbname === '') {
    $dbname = 'relievv';
}

$dbport = getenv('DB_PORT');
if ($dbport === false || $dbport === '') {
    $dbport = getenv('MYSQL_PORT');
}
if (($dbport === false || $dbport === '') && $urlParts !== false && isset($urlParts['port'])) {
    $dbport = $urlParts['port'];
}
$dbport = (int) ($dbport ?: 3306);

// Prevent uncaught mysqli exceptions so we can show a clear deploy-time error.
if (!function_exists('mysqli_connect')) {
    http_response_code(500);
    echo "Database driver missing: mysqli extension is not enabled in this container.";
    exit;
}
mysqli_report(MYSQLI_REPORT_OFF);
$con = @mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
if (!$con) {
    http_response_code(500);
    echo "Database connection failed. Check DB_HOST/DB_PORT in Coolify. ";
    echo "Tried host: " . htmlspecialchars($dbhost, ENT_QUOTES, 'UTF-8') . ":" . $dbport;
    exit;
}
?>
