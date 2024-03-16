<?php
// Bắt đầu phiên đăng nhập
session_start();

require_once "../config/config.php";

// Kiểm tra xem người dùng đã submit form đăng nhập chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Lấy thông tin đăng nhập từ form
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Tìm kiếm người dùng trong cơ sở dữ liệu
  $sql = "SELECT * FROM admin WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role']; // Lưu role vào session
    header('Location: index.php'); // Chuyển hướng đến trang admin
    exit();
    } else {
      echo "Tài khoản hoặc mật khẩu không đúng.";
  }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="../admin/assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;1,100;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <script src="./public/js/javascript.js"></script>
</head>

<body>
    <div class="login-container">
        <?php if (isset($error)) { echo $error; } ?>
        <form id="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1>Đăng nhập Admin</h1>
            <label>Tên người dùng</label><br>
            <input type="text" name="username"><br>
            <label>Mật khẩu</label><br>
            <input type="password" name="password"><br>
            <input id="btn-signup" type="submit" name="submit" value="Đăng nhập">
        </form>
    </div>
</body>

</html>