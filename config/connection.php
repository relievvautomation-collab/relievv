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
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = (int)(getenv('DB_PORT') ?: 3306);

$con = mysqli_connect($host, $user, $pass, $dbname, $port);

if (!$con) {
    die("Database connection failed. Error: " . mysqli_connect_error() . 
        " | Host: $host | User: $user | DB: $dbname | Port: $port");
}
?>

