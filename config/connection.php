<?php
// Local XAMPP defaults; Coolify/Docker: set DB_HOST, DB_USER, DB_PASSWORD, DB_NAME in environment
$dbhost = getenv('DB_HOST') ?: 'localhost';
$dbuser = getenv('DB_USER') ?: 'root';
$dbpassword = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '';
$dbname = getenv('DB_NAME') ?: 'relievv';
$con = mysqli_connect($dbhost , $dbuser , $dbpassword ,$dbname);
if(!$con){
    echo "Connection failed: " . mysqli_connect_error();
}
?>