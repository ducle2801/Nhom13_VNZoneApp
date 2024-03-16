<?php
    // Kết nối đến CSDL
    require_once '../config/config.php';

    // Lấy dữ liệu từ form
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $category_slug = $_POST['category_slug'];
    $description = $_POST['product_description'];
    $product_id = $_POST['product_id'];

    // Lấy category_id từ category_slug
    $query = "SELECT id FROM categories WHERE slug = '$category_slug'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $category_id = $row['id'];

    // Lưu thông tin sản phẩm vào CSDL
    $query = "UPDATE products SET name = '$name', price = '$price', description = '$description', category_id = '$category_id', category_slug = '$category_slug' WHERE id='$product_id'";
    mysqli_query($conn, $query);


    // Lưu ảnh sản phẩm vào thư mục và đường dẫn vào CSDL
    $product_id = $_POST['product_id'];

    // Xóa ảnh cũ trên CSDL và thư mục lưu trữ
    $query = "SELECT * FROM product_images WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $image_path = $row['image_path'];
        unlink($image_path);
        $query_delete = "DELETE FROM product_images WHERE id = '{$row['id']}'";
        mysqli_query($conn, $query_delete);
    }

    $target_dir = "../uploads/";
    $images = $_FILES['images'];
    foreach ($images['tmp_name'] as $key => $tmp_name) {
        $target_file = $target_dir . basename($images['name'][$key]);
        move_uploaded_file($tmp_name, $target_file);
        $image_path = '' . $target_file;
        $query = "INSERT INTO product_images (product_id, image_path) VALUES ('$product_id', '$image_path')";
        mysqli_query($conn, $query);
    }

    // Chuyển hướng đến trang chi tiết sản phẩm vừa chỉnh sửa
    header("Location: quanlysanpham.php");
    exit;
?>