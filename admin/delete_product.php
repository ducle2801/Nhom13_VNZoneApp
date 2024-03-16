<?php
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $sql = "DELETE FROM products WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        // Trả về thông báo về kết quả trả về cho client-side
        echo "Product with id=$id has been deleted successfully";
    } else {
        echo 'Xóa sản phẩm thất bại: ' . mysqli_error($conn);
    }
}
?>