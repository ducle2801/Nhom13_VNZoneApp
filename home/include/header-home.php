<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="../home/assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;1,100;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <script src="../home/assets/js/javascript.js"></script>
</head>

<body>
    <header>
        <div class="header-top">
            <div class="header-top-container">
                <div class="header-top-left">
                    <li><a href="">Kênh người bán</a></li>
                    <li><a href="">Kết nối với chúng tôi<i class="fa-brands fa-facebook"></i><i
                                class="fa-brands fa-twitter"></i></a>
                    </li>
                </div>
                <div class="header-top-right">
                    <li>
                        <select id="language-select" name="language">
                            <option value="vi">Tiếng Việt</option>
                            <option value="en">Tiếng Anh</option>
                        </select>
                    </li>
                    <li>
                        <?php
                        session_start();
                        if(isset($_SESSION['username'])){?>
                        <div class="dropdown">
                            <span id='name-user'><?php echo $_SESSION['username']; ?></span>
                            <div class="dropdown-content">
                                <a href="">Hồ sơ của tôi</a>
                                <a href="cart.php">Giỏ hàng</a>
                                <a id='btn-logout' href="logout.php">Đăng xuất</a>
                            </div>
                        </div>
                        <?php } else{?>
                        <a href="login.php">Đăng ký|Đăng nhập</a>
                        <?php }?>
                    </li>
                </div>
            </div>
        </div>

        <div class="header-main">
            <div class="header-main-logo">
                <a href="index.php">
                    <i class="fa-brands fa-shopify"></i>
                    <h1>BuyZone</h1>
                </a>
            </div>
            <div class="header-main-search">
                <form action="search.php" method="GET">
                    <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm tại đây...">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="header-main-cart">
                <div class="notify">
                    <a href=""><i class="fa-solid fa-bell"></i></a>
                </div>
                <div class="cart">
                    <a href="cart.php" id="cart-icon">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="count" data-count="0"></span>
                    </a>
                </div>
            </div>

        </div>

        <div class="header-bottom">
            <div class="header-bottom-container">
                <div class="header-bottom-all-category">
                    <span><i class="fa-solid fa-list"></i>Tất cả danh mục</span>
                </div>
                <div class="header-bottom-all-link">
                    <ul>
                        <li><a href="index.php">Trang chủ<i class="fa-solid fa-angle-down"></i></a></li>
                        <li><a href="gioithieu.php">Giới thiệu<i class="fa-solid fa-angle-down"></i></a></li>
                        <li><a href="hotro.php">Hỗ trợ khách hàng<i class="fa-solid fa-angle-down"></i></a></li>
                        <li><a href="chinhsach.php">Chính sách và điều khoản<i class="fa-solid fa-angle-down"></i></a>
                        </li>
                        <li><a href="">Liên hệ<i class="fa-solid fa-angle-down"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </header>