<?php
    // Kết nối đến CSDL
    require_once '../config/config.php';

    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $price = (float) $price;
    $category_slug = $_POST['category_slug'];
    $description = $_POST['description'];

    // Kiểm tra xem danh mục có tồn tại không
    $sql = "SELECT id FROM categories WHERE slug = '$category_slug'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        die("Invalid category!");
    }

    // Lấy id của danh mục
    $category_id = mysqli_fetch_assoc($result)["id"];

    // Upload hình ảnh lên server
    // Tạo thư mục nếu chưa tồn tại
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Lưu thông tin sản phẩm vào CSDL
    $query = "INSERT INTO products (name, price, description, category_slug, category_id) VALUES ('$name', '$price', '$description', '$category_slug', '$category_id')";
    mysqli_query($conn, $query);

    // Lấy ID của sản phẩm vừa thêm vào CSDL
    $product_id = mysqli_insert_id($conn);

    // Lưu ảnh sản phẩm vào thư mục và đường dẫn vào CSDL
    $target_dir = "../uploads/";
    $images = $_FILES['images'];
    foreach ($images['tmp_name'] as $key => $tmp_name) {
        $target_file = $target_dir . basename($images['name'][$key]);
        move_uploaded_file($tmp_name, $target_file);
        $image_path = '' . $target_file;
        $query = "INSERT INTO product_images (product_id, image_path) VALUES ('$product_id', '$image_path')";
        mysqli_query($conn, $query);
    }

    // Chuyển hướng đến trang chi tiết sản phẩm vừa thêm
    header("Location: quanlysanpham.php");
    exit;
?>