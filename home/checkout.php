<?php 

require_once "../config/config.php" ?>

<?php include_once "../home/include/header-home.php"?>


<main class="container">

    <section id="product-details">
        <h1 class="checkout-name">THANH TOÁN</h1>
        <?php
    if (empty($_SESSION['cart'])) {
        echo 'Giỏ hàng của bạn đang trống';
    } else {
        $total_price = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['product_price'] * $item['quantity'];
            $total_price += $subtotal;
        }
        echo '<table class="checkout-tab">';
        echo '<tr class="checkout-title">
        <th class="checkout-product">Sản phẩm</th>
        <th class="checkout-price">Giá</th>
        <th class="checkout-num">Số lượng</th>
        <th class="checkout-total">Tổng cộng</th>
                </tr>';
        foreach ($_SESSION['cart'] as $item) {
            echo '<tr>';
            echo '<td>' . $item['product_name'] . '</td>';
            echo '<td class="product-price">' . number_format($item['product_price'], 0, '.', ',') . ' đ' . '</td>';
            echo '<td class="product-quantity">' . $item['quantity'] . '</td>';
            echo '<td class="product-total">' . number_format($item['product_price'] * $item['quantity'], 0, '.', ',') . ' đ' . '</td>';
            echo '</tr>';
        }
        echo '<tr><td colspan="3">Tổng tiền:</td><td class="product-total">' . number_format($total_price, 0, '.', ',') . ' đ' . '</td></tr>';
        echo '</table>';

        echo '<form class="checkout-post" method="post" action="checkout_process.php">';
        echo '<label class="checkout-label">Họ tên:</label><br>';
        echo '<input class="checkout-input" type="text" name="name" required><br>';
        echo '<label class="checkout-label">Địa chỉ:</label><br>';
        echo '<input class="checkout-input" type="text" name="address" required><br>';
        echo '<label class="checkout-label">Số điện thoại:</label><br>';
        echo '<input class="checkout-input" type="text" name="phone" required><br>';
        echo '<label class="checkout-label">Email:</label><br>';
        echo '<input class="checkout-input" type="email" name="email" required><br>';
        echo '<button class="checkout-btn" type="submit" name="checkout">Đặt hàng</button>';
        echo '</form>';
    }
    ?>
    </section>
</main>


<?php include_once "../home/include/footer-home.php"?>