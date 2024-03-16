<?php

require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['category_id'];
    $name = $_POST['category_name'];
    $slug = $_POST['slug'];

    // Check if category_image is set and not empty
    if (isset($_FILES['imageInputEdit']) && !empty($_FILES['imageInputEdit']['name'])) {
        $image = $_FILES['imageInputEdit'];
        $image_path = '../uploads/' . time() . '_' . $image['name'];
        move_uploaded_file($image['tmp_name'], $image_path);
        $sql = "UPDATE categories SET name='$name', slug='$slug', category_image='$image_path' WHERE id='$id'";
    }
    
    if (mysqli_query($conn, $sql)) {
        header('Location: quanlydanhmuc.php');
        exit();
    } else {
        echo 'Chỉnh sửa thất bại: ' . mysqli_error($conn);
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM categories WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $category = mysqli_fetch_assoc($result);
}

?>