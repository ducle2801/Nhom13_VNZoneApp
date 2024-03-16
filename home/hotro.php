<?php require_once "../config/config.php" ?>
<!DOCTYPE html>
<html>

<head>
    <title>Trang hỗ trợ khách hàng</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="../home/assets/css/hotro.css">
    <!-- <link rel="stylesheet" href="../home/assets/css/home.css"> -->
    <script src="../admin//assets//js//javascript.js"></script>
</head>

<body>
    <header>
        <div class="header-container">
            <div class="logo-container">
                <i class="fa-brands fa-shopify"></i>
                <a href="index.php">Buy<span>Zone</span></a>
            </div>
            <div class="brand-container">
                <h2>|</h2>
            </div>
            <div class="text-container">
                <h1>Trung tâm hổ trợ của BuyZone VN</h1>
            </div>
            <div class="head-policy">
                <a href="chinhsach.php"><span>Chinh sách và quy tắc của Buy Zone</span></a>
            </div>
        </div>
    </header>

    <main id="main-sp">
        <div class="container">
            <div class="container-text">
                <h2>Xin chào BuyZoneVn có thể giúp gì cho bạn hay không?</h2>
            </div>
            <div class="container-dv">
                <section id="dichvu">
                    <h3>Dịch vụ</h3>
                    <ul>
                        <li>Hổ trợ khách hàng qua điện thoại</li>
                        <li>Hổ trợ khách hàng qua email</li>
                        <li>Hổ trợ khách hàng trực tuyến</li>
                    </ul>
                </section>

                <section id="cauhoi">
                    <h3>Câu hỏi thường gặp</h3>
                    <ul>
                        <li><a href="#faq1">Tôi có thể đổi trả sản phẩm không?</a></li>
                        <li><a href="#faq2">Thời gian giao hàng bao lâu?</a></li>
                        <li><a href="#faq3">Có hỗ trợ vận chuyển nhanh không?</a></li>
                    </ul>
                    <div id="faq1">
                        <h3>Tôi có thể đổi trả sản phẩm không?</h3>
                        <p>
                            Chúng tôi hỗ trợ đổi trả sản phẩm trong vòng 30 ngày kể từ ngày
                            mua hàng. Vui lòng liên hệ với chúng tôi để được hướng dẫn chi
                            tiết về quy trình đổi trả.
                        </p>
                    </div>

                    <div id="faq2">
                        <h3>Thời gian giao hàng bao lâu?</h3>
                        <p>
                            Thời gian giao hàng phụ thuộc vào địa chỉ nhận hàng của bạn và
                            phương thức vận chuyển bạn chọn. Thông thường, thời gian giao
                            hàng là từ 3 đến 7 ngày.
                        </p>
                    </div>

                    <div id="faq3">
                        <h3>Có hỗ trợ vận chuyển nhanh không?</h3>
                        <p>
                            Chúng tôi có các phương thức vận chuyển nhanh nhưng phụ thuộc
                            vào khu vực nhận hàng của bạn. Vui lòng liên hệ với chúng tôi để
                            biết thêm chi tiết về phương thức vận chuyển nhanh và phí vận
                            chuyển.
                        </p>
                    </div>
                </section>
                <section id="lienhe">
                    <h3>Liên hệ</h3>
                    <p>
                        Để biết thêm thông tin chi tiết về các dịch vụ hổ trợ khách hàng
                        của chúng tối xin vui lòng liên hệ:
                    </p>
                    <ul>
                        <li>Email:hotro@support.com</li>
                        <li>Điện thoại:1900-1874</li>
                        <li>Địa chỉ : 3/2,Quận Ninh Kiều,TP.Cần Thơ</li>
                    </ul>
                </section>
            </div>
        </div>
    </main>
    <?php include_once "../home/include/footer-home.php" ?>
</body>

</html>