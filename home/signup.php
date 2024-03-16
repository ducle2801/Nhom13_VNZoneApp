<?php
require_once '../config/config.php';
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
    $error = 'Mật khẩu và xác nhận mật khẩu không khớp.';
  }

  // Kiểm tra xem tên đăng nhập đã được sử dụng chưa
  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $error = 'Tên đăng nhập đã được sử dụng.';
  }

  // Nếu không có lỗi, thêm thông tin người dùng vào cơ sở dữ liệu
  if (!isset($error)) {
    $sql = "INSERT INTO users (fullname, email, address, username, password) VALUES ('$fullname','$email','$address','$username', '$password')";

    if (mysqli_query($conn, $sql)) {
      header('Location: login.php');
      exit();
    } else {
      $error = 'Đăng ký thất bại. Vui lòng thử lại sau.';
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../home/assets/css/signup.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;1,100;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <script src="../home/assets/js/javascript.js"></script>
    <script src="../home/assets/js/signup.js"></script>
    <!-- <script src="..//admin//assets//js//signup.js"></script> -->
</head>

<body>
    <div class="signup-container">


        <?php if (isset($error)) : ?>
        <p style="color:red"><?php echo $error ?></p>
        <?php endif; ?>

        <form id="singup-form" action="register.php" method="POST" onsubmit="return signup()">
            <div class="form-group">
                <h1>Đăng Kí</h1>
            </div>
            <div class="form-group">
                <input type="text" id="fullname" name="fullname" autocomplete="off" />
                <label>Full Name</label>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" autocomplete="off" />
                <label>Email</label>
            </div>
            <div class="form-group">
                <input type="text" id="address" name="address" autocomplete="off" />
                <label>Address</label><br />
            </div>
            <div class="form-group">
                <input type="text" id="username" name="username" autocomplete="off" />
                <label>User Name</label><br />
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" autocomplete="off" />
                <label>Password</label>
                <i class="fa-regular fa-eye" onclick="changeTypePassword()"></i>
                <i class="fa-regular fa-eye-slash" onclick="changeTypePassword()"></i>
            </div>
            <div class="form-group">
                <input type="password" id="confirm_password" name="confirm_password" autocomplete="off" />
                <label>Comfirm Password</label>
                <i class="fa-regular fa-eye" onclick="changeTypePassword2()"></i>
                <i class="fa-regular fa-eye-slash" onclick="changeTypePassword2()"></i>
            </div>
            <div class="form-group">
                <input id="btn-signup" type="submit" value="Sign up" />
                <p>Already have an Account?</p>

                <a href="login.php">Login Here</a>
            </div>
        </form>
    </div>

    <?php include_once "../home/include/footer-home.php" ?>
</body>

</html>
Đang hiển thị 4085239174894694471.