<?php

// Khởi động session
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    // Nếu người dùng chưa đăng nhập thì chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit();
}

require_once "config.php";
$username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;1,100;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <script src="./public/js/javascript.js"></script>
</head>

<body>
    <header>
        <div class="header">
            <div class="navbar">
                <nav>
                    <ul>
                        <li><a href="">Bán hàng cùng chúng tôi</a></li>
                        <li><a href="">Chăm sóc khách hàng</a></li>
                        <li><a href="">Kiểm tra đơn hàng</a></li>
                        <li><a href="signup.php">Đăng kí</a></li>
                        <li>
                            <?php
			                    session_start();
			                    if(isset($_SESSION['username'])) {
				                    echo "Xin chào " . $_SESSION['username'] . "! ";
				                    echo "<button onclick=\"dangXuat()\">Đăng xuất</button>";
			                    } else {
				                    echo "<a href=\"login.php\">Đăng nhập</a>";
			                    }
		                    ?>
                        </li>
                        <li><a href="" class="activemenu">Thay đổi ngôn ngữ</a>
                            <ul class="dropmenu">
                                <li><a href=""><img src="./public/images/home/logovn.png" alt="">Vietnamese</a></li>
                                <li><a href=""><img src="./public/images/home/logoen.jpg" alt="">English</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="searchbar">
                <div class="logo">VN-ZONE</div>
                <div class="search">
                    <input type="text" placeholder="Tìm kiếm sản phẩm..."><a href=""><i
                            class="fa-solid fa-magnifying-glass"></i></a>
                </div>
                <div class="notification">
                    <div class="cart"><a href=""><i class="fa-solid fa-cart-shopping"></i></a></div>
                    <div class="notify"><a href=""><i class="fa-solid fa-bell"></i></a></div>
                </div>
            </div>
        </div>
    </header>

    <article>

        <h1>Thông tin người dùng</h1>
        <p><strong>Họ và tên:</strong> <?php echo $user['fullname']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Địa chỉ:</strong> <?php echo $user['address']; ?></p>
        <img src="<?php echo $user['avatar']; ?>" alt="Ảnh đại diện">

    </article>

    <footer>
        <div class="foot-container">
            <div class="foot-all">
                <div class="foot-left">
                    <h2>CHĂM SÓC KHÁCH HÀNG</h2>
                    <a href="">Trung tâm trợ giúp</a>
                    <a href="">Hướng dẫn mua hàng</a>
                    <a href="">Thanh toán</a>
                    <a href="">Vận chuyển</a>
                    <a href="">Chăm sóc khách hàng</a>
                    <a href="">Chính sách bảo hành</a>
                </div>

                <div class="foot-center">
                    <h2>KẾT NỐI VỚI CHÚNG TÔI</h2>
                    <img src="./public/images/home/icon-fb.png" alt="">
                    <img src="./public/images/home/icon-instagram.png" alt="">
                    <img src="./public/images/home/icon-linkedin.png" alt="">
                    <img src="./public/images/home/icon-pinterest.png" alt="">
                </div>
                <div class="foot-right">
                    <h2>LIÊN HỆ</h2>
                    <h3><i class="fa-solid fa-globe"></i>VN-ZONE</h3>
                    <h3><i class="fa-solid fa-phone"></i>099 9999 999</h3>
                    <h3><i class="fa-solid fa-envelope"></i>vnzone@gmail.com</h3>
                    <h3><i class="fa-solid fa-location-dot"></i>3/2, Ninh Kieu, Can Tho</h3>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>