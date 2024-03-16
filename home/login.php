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
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Lưu thông tin người dùng vào session để sử dụng ở các trang khác
        $_SESSION['username'] = $username;
        header('Location: index.php'); // Chuyển đến trang chính của người dùng
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
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../home/assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;1,100;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <script src="../assets/js/javascript.js"></script>
    <script src="..//admin//assets//js//login.js"></script>
</head>

<body>
    <div class="login-container">
        <?php if (isset($error)) {
            echo $error;
        } ?>
        <form id="login-form" method="POST" onsubmit="return login()"
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="form-group">
                <h1>Đăng Nhập</h1>
            </div>
            <div class="form-group">
                <input type="text" id="username" name="username" required />
                <label for="">User Name</label>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" autocomplete="off" required />
                <label for="">Mật khẩu</label>
                <i class="fa-regular fa-eye" onclick="changeTypePassword()"></i>
                <i class="fa-regular fa-eye-slash" onclick="changeTypePassword()"></i>
            </div>
            <div class="form-group">
                <input id="btn-signup" type="submit" name="submit" value="Login" />
                <p>Don't have an Account?</p>
                <a href="signup.php">Signup Here</a><br />
            </div>
        </form>
    </div>
</body>

</html>