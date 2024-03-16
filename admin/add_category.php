<?php

require_once '../config/config.php';

session_start();

// Kiểm tra nếu form đã được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Lấy giá trị tên danh mục
  $category_name = $_POST['category_name'];
  $slug = $_POST['slug'];
  // Kiểm tra xem người dùng đã chọn tệp ảnh để tải lên hay chưa
  if (isset($_FILES['imageInput'])) {
    // Lấy tên tệp ảnh và thư mục tạm
    $category_image = $_FILES['imageInput']['name'];
    $tmp_name = $_FILES['imageInput']['tmp_name'];
    // Đường dẫn lưu tệp ảnh trên server
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($category_image);
    // Kiểm tra tệp ảnh có tồn tại và di chuyển tệp ảnh vào thư mục uploads trên server
    if (move_uploaded_file($tmp_name, $target_file)) {
        // Thêm dữ liệu vào CSDL
        $sql = "INSERT INTO categories (name, category_image, slug) VALUES ('$category_name', '$category_image', '$slug')";
        if (mysqli_query($conn, $sql)) {
            // Lưu thông báo thành công vào session
            $_SESSION['success_msg'] = 'Thêm danh mục thành công';
            header("Location: quanlydanhmuc.php");
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "Upload ảnh không thành công!";
    }
  } else {
      echo "Bạn chưa chọn ảnh để tải lên!";
  }
}

?>