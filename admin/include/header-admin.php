<?php

require_once "../config/config.php";

session_start();
if (!isset($_SESSION['username'])) {
  header("Location: loginadmin.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../admin/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;1,100;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <script src="../admin/assets/js/javascript.js"></script>

</head>

<body>
    <header>
        <div class="header-container">
            <div class="head-logo">
                <a href="index.php">
                    <i class="fa-brands fa-shopify"></i>
                    <h1>ADMIN DASHBOARD</h1>
                </a>
            </div>
            <div class="head-search">
                <input type="text" name="" id="" placeholder="Tìm kiếm...">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="head-notify">
                <i class="fa-regular fa-bell"></i>
                <i class="fa-regular fa-comment"></i>
            </div>
            <div class="head-info">
                <div class="user-info">
                    <?php
                        if(isset($_SESSION['username'])) {
                            if($_SESSION['role'] === 'admin') {
                                echo "<h1>Xin chào, " . $_SESSION['username'] . "! </h1>";
				                echo "<button class='btn-logout' onclick=\"dangXuat()\">Đăng xuất</button>";
                            } else {
                                header ("Location: ../home/index.php");
                            }
                        }else {
                            echo "<button>Đăng nhập</button>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </header>