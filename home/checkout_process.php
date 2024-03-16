<?php
require_once '../config/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';

include_once "../home/include/header-home.php"?>

<main>

    <section id="product-details">

        <?php

            if (isset($_POST['checkout'])) {
                $name = $_POST['name'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];

                // Lưu đơn hàng vào bảng đơn hàng
                $total_price = 0;
                foreach ($_SESSION['cart'] as $item) {
                $subtotal = $item['product_price'] * $item['quantity'];
                $total_price += $subtotal;
                $total_price1 = number_format($total_price, 0, '.', ',') . ' đ';
            }

            $status = 'Chưa thanh toán'; // Trạng thái mặc định là chưa thanh toán

            // Tạo đơn hàng mới
            $query = "INSERT INTO orders (customer_name, address, phone, email, total_price, status)
            VALUES ('$name', '$address', '$phone', '$email', '$total_price', '$status')";
            $result = mysqli_query($conn, $query);

            // Lấy ID đơn hàng vừa tạo
            $order_id = mysqli_insert_id($conn);

            // Lưu chi tiết đơn hàng vào bảng order_items
            foreach ($_SESSION['cart'] as $item) {
                $product_id = $item['product_id'];
                $product_name = $item['product_name'];
                $product_price = $item['product_price'];
                $quantity = $item['quantity'];

                $query = "INSERT INTO order_items (order_id, product_id, product_name, product_price, quantity)
                VALUES ('$order_id', '$product_id', '$product_name', '$product_price', '$quantity')";
                $result = mysqli_query($conn, $query);
            }

            // Xóa giỏ hàng sau khi đã đặt hàng
            unset($_SESSION['cart']);

            // Gửi email thông báo đơn hàng cho khách hàng
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0; // Enable verbose debug output
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'dck28012001@gmail.com'; // SMTP username
                $mail->Password = 'gwnvemyltwgineia'; // SMTP password
                $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587; // TCP port to connect to


                //Recipients
                $mail->setFrom('dck28012001@gmail.com', 'BuyZone');
                $mail->addAddress($email); // Add a recipient
                $mail->addReplyTo('dck28012001@gmail.com', 'BuyZone');

                //Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Xác nhận đơn hàng';
                $mail->Body = "Đơn hàng của bạn đã được tiếp nhận.<br><br>Thông tin đơn hàng:<br>Tên: $name<br>Địa chỉ:
                $address<br>Số điện thoại: $phone<br>Email: $email<br><br>Tổng tiền: $total_price1";
                
                $mail->send();
                echo '<div class="checkout-process"';
                echo '<h1>Đặt hàng thành công. Vui lòng kiểm tra email của bạn để xem thông tin chi tiết đơn hàng.</h1>';
                echo '<a href="index.php">Tiếp tục mua sắm</a>';
                echo '<img src="../home/assets/images/Home/checkout-procees.png" alt="">';
                echo '</div>';
            } catch (Exception $e) {
                echo "Lỗi: {$mail->ErrorInfo}";
            }
        }
        ?>

    </section>
</main>


<?php include_once "../home/include/footer-home.php"?>