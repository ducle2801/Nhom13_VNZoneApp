<?php
// Khởi động session
session_start();
require_once '../config/config.php';

// Lấy thông tin sản phẩm từ form
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Kiểm tra số lượng sản phẩm
if ($quantity <= 0) {
    // Nếu số lượng nhỏ hơn hoặc bằng 0, hiển thị thông báo lỗi và chuyển hướng trở lại trang sản phẩm
    $_SESSION['error'] = "Số lượng sản phẩm phải lớn hơn 0.";
    header("Location: product.php?id=$product_id");
    exit();
}

// Truy vấn cơ sở dữ liệu để lấy thông tin sản phẩm
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    // Nếu không tìm thấy sản phẩm, hiển thị thông báo lỗi và chuyển hướng trở lại trang sản phẩm
    $_SESSION['error'] = "Không tìm thấy sản phẩm.";
    header("Location: product.php?id=$product_id");
    exit();
}

// Lấy thông tin sản phẩm từ kết quả truy vấn
$product = mysqli_fetch_assoc($result);

// Thêm sản phẩm vào giỏ hàng
if (!isset($_SESSION['cart'])) {
    // Nếu giỏ hàng chưa được tạo, tạo mới một giỏ hàng trống
    $_SESSION['cart'] = array();
}

// Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
if (array_key_exists($product_id, $_SESSION['cart'])) {
    // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng sản phẩm lên
    $_SESSION['cart'][$product_id]['quantity'] += $quantity;
} else {
    // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm vào giỏ hàng với số lượng là $quantity
    $_SESSION['cart'][$product_id] = array(
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => $quantity
    );
}

// Hiển thị thông báo thành công và chuyển hướng về trang sản phẩm
$_SESSION['success'] = "Sản phẩm đã được thêm vào giỏ hàng.";

?>