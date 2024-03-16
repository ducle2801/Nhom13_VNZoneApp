<?php
require_once "../config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Lấy thông tin từ form đăng ký
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Kiểm tra xem mật khẩu và xác nhận mật khẩu có khớp nhau không
  if ($password != $confirm_password) {
    header('Location: register.php?error=confirm_password');
    exit();
  }

  // Kiểm tra xem tên đăng nhập đã được sử dụng chưa
  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    header('Location: signup.php?dang_ky_that_bai');
    return;
  }

  // Thêm thông tin người dùng vào cơ sở dữ liệu
  $sql = "INSERT INTO users (fullname, email, address, username, password) VALUES ('$fullname','$email','$address','$username', '$password')";

  if (mysqli_query($conn, $sql)) {
    header('Location: login.php');
    exit();
  } else {
    echo 'Đăng ký thất bại: ' . mysqli_error($conn);
  }
}
?>