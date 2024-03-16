<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'buyzone';

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
  die('Kết nối thất bại: ' . mysqli_connect_error());
}

?>