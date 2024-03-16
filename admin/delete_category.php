<?php
require_once '../config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM categories WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        // Chuyển hướng trang web về quanlydanhmuc.php
        header('Location: quanlydanhmuc.php');
        exit();
    } else {
        echo 'Xóa danh mục thất bại: ' . mysqli_error($conn);
    }
}
?>