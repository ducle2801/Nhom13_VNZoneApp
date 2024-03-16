<?php 

require_once "../config/config.php" ?>

<?php include_once "../home/include/header-home.php"?>

<main>


    <section id="product-details">
        <div class="cart-title">
            <h1>Giỏ hàng</h1>
        </div>
        <?php

    // Kiểm tra xem giỏ hàng đã được tạo chưa
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (!isset($_SESSION['username']) || !$_SESSION['username']) {
        header("Location: login.php");
        exit();
    } else {

// Nếu người dùng đã thêm sản phẩm vào giỏ hàng
if (isset($_POST['add_to_cart'])) {
    // Lấy thông tin sản phẩm và số lượng từ form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

    // Lấy số lượng sản phẩm trong giỏ hàng
    $num_items = count($_SESSION['cart']);

    // Biến tạm để lưu trữ tên sản phẩm trước đó
    $previous_product_name = '';

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    for ($i = 0; $i < $num_items; $i++) {
        if ($_SESSION['cart'][$i]['product_id'] == $product_id) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cộng thêm số lượng
            $_SESSION['cart'][$i]['quantity'] += $quantity;
            break;
        }
        // Lưu trữ tên sản phẩm trước đó
        $previous_product_name = $_SESSION['cart'][$i]['product_name'];
    }

    // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm vào giỏ hàng
    if ($i == $num_items) {
        // Tạo một mảng chứa thông tin sản phẩm mới
        $new_item = array(
            'product_id' => $product_id,
            'product_name' => $previous_product_name == $product_name ? $product_name . ' (2)' : $product_name,
            'product_price' => $product_price,
            'quantity' => $quantity
        );

        // Thêm sản phẩm vào giỏ hàng
        $_SESSION['cart'][] = $new_item;
    }
 
}
    }



    // Xóa sản phẩm khỏi giỏ hàng
    if (isset($_GET['remove'])) {
        $product_id = $_GET['remove'];
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }

    // Xóa sản phẩm đã chọn
if (isset($_POST['delete_selected'])) {
    $product_ids = $_POST['product_ids'];

    foreach ($product_ids as $product_id) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }
}

if (isset($_POST['update_cart'])) {
    // Lấy thông tin số lượng mới của từng sản phẩm từ form
    $new_quantities = $_POST['quantity'];

    // Tạo mảng tạm để lưu các phần tử cập nhật
    $updated_items = array();

    // Cập nhật số lượng mới vào giỏ hàng và lưu các phần tử cập nhật vào mảng tạm
    foreach ($_SESSION['cart'] as $key => &$item) {
        $new_quantity = $new_quantities[$key];
        if ($new_quantity > 0) {
            // Nếu số lượng sản phẩm lớn hơn 0, cập nhật số lượng mới
            $item['quantity'] = $new_quantity;
            $updated_items[$key] = $item; // Thêm vào mảng tạm
        } else {
            // Nếu số lượng sản phẩm là 0, không thêm vào mảng tạm và không cập nhật giỏ hàng
            unset($_SESSION['cart'][$key]);
        }
    }

    // Ghi đè giỏ hàng bằng các phần tử cập nhật
    $_SESSION['cart'] = $updated_items;
}













if (!empty($_SESSION['cart'])) {
    echo '<form id="cart-form" method="post" action="cart.php">';
    echo '<table>';
    echo '<tr><th>Tất cả</th><th>Sản phẩm</th><th>Giá</th><th>Số lượng</th><th>Tổng cộng</th><th>Thao tác</th></tr>';
    foreach ($_SESSION['cart'] as $key => $item) {
        $subtotal = $item['product_price'] * $item['quantity'];
        echo '<tr>';
        echo '<td><input type="checkbox" name="product_ids[]" value="' . $item['product_id'] . '"></td>';
        echo '<td>' . $item['product_name'] . '</td>';
        echo '<td>' . number_format($item['product_price'], 0, '.', ',') . ' đ' . '</td>';
        echo '<td><input type="number" name="quantity[]" value="' . $item['quantity'] . '" min="1"></td>';
        echo '<td>' . number_format($subtotal, 0, '.', ',') . ' đ' . '</td>';
        echo '<td><a href="cart.php?remove=' . $item['product_id'] . '"><i class="fa-solid fa-trash-can"></i></a></td>';
        echo '</tr>';
    }
    echo '</table>';

    echo '<button type="submit" name="update_cart">Cập nhật giỏ hàng</button>';
    echo '<button type="submit" name="delete_selected" value="true">Xóa sản phẩm đã chọn</button>';
    echo '</form>';

    echo '<form id="checkout-form" method="post" action="checkout.php">';
    echo '<button type="submit" name="checkout">Thanh toán toàn bộ giỏ hàng</button>';
    echo '</form>';
} else {
    echo 'Giỏ hàng của bạn đang trống';
    echo '<a href="index.php">Mua sắm ngay</a>';
}

    ?>

    </section>
</main>

<script>
// function updateCartItem(productId, newQuantity) {
//     // Tính lại tổng tiền
//     var itemRow = document.getElementById('cart-item-' + productId);
//     var itemPrice = itemRow.querySelector('.cart-item-price').textContent;
//     var totalPrice = newQuantity * itemPrice;
//     var totalRow = itemRow.querySelector('.cart-item-total');
//     totalRow.textContent = totalPrice;

//     // Gửi yêu cầu cập nhật số lượng sản phẩm trên server
//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', 'update_cart.php');
//     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//     xhr.onload = function() {
//         if (xhr.status === 200) {
//             // Cập nhật lại tổng tiền
//             var total = xhr.responseText;
//             document.getElementById('cart-total').textContent = total;
//         }
//     };
//     xhr.send('product_id=' + productId + '&quantity=' + newQuantity);
// }

// // Lắng nghe sự kiện thay đổi số lượng sản phẩm
// var quantityInputs = document.querySelectorAll('.cart-item-quantity');
// quantityInputs.forEach(function(quantityInput) {
//     quantityInput.addEventListener('change', function() {
//         var productId = this.dataset.productId;
//         var newQuantity = this.value;
//         updateCartItem(productId, newQuantity);
//     });
// });
</script>

<?php include_once "../home/include/footer-home.php"?>