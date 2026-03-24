// <?php
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
// Local XAMPP defaults; Coolify/Docker can provide DB_* or MYSQL_* variables.
$dbhost = getenv('DB_HOST') ?: (getenv('MYSQL_HOST') ?: 'localhost');
$dbuser = getenv('DB_USER') ?: (getenv('MYSQL_USER') ?: 'root');
$dbpassword = getenv('DB_PASSWORD');
if ($dbpassword === false) {
    $dbpassword = getenv('MYSQL_PASSWORD');
}
if ($dbpassword === false) {
    $dbpassword = '';
}
$dbname = getenv('DB_NAME') ?: (getenv('MYSQL_DATABASE') ?: 'relievv');
$dbport = (int) (getenv('DB_PORT') ?: (getenv('MYSQL_PORT') ?: 3306));

// Prevent uncaught mysqli exceptions so we can show a clear deploy-time error.
mysqli_report(MYSQLI_REPORT_OFF);
$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
if (!$con) {
    http_response_code(500);
    echo "Database connection failed. Check DB_HOST/DB_PORT in Coolify. ";
    echo "Tried host: " . htmlspecialchars($dbhost, ENT_QUOTES, 'UTF-8') . ":" . $dbport;
    exit;
}
?>
