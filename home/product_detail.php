<?php
// Kết nối CSDL
require_once '../config/config.php';

// Lấy ID của sản phẩm từ tham số truyền vào
$product_id = $_GET['id'];

// Truy vấn CSDL để lấy thông tin sản phẩm
$query = "SELECT products.*, categories.name as category_name
FROM products 
JOIN categories
ON products.category_id = categories.id 
WHERE products.id = $product_id
";
$result = mysqli_query($conn, $query);
$products = mysqli_fetch_assoc($result);

// Kiểm tra xem sản phẩm có tồn tại hay không
if (!$products) {
    echo "Không tìm thấy sản phẩm";
    exit;
}

// Truy cập vào giá và mô tả của sản phẩm
$name = $products['name'];
$category_name = $products['category_name'];
$price = $products['price'];
$description = $products['description'];
$category_slug = $products['category_slug'];


// Truy vấn CSDL để lấy thông tin ảnh sản phẩm
$query = "SELECT products.*, categories.slug as category_slug, categories.name AS category_name, product_images.image_path
FROM products 
JOIN categories
ON products.category_id = categories.id 
JOIN product_images
ON products.id = product_images.product_id
WHERE products.id = $product_id
";

$result = mysqli_query($conn, $query);
$images = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php require_once "../config/config.php" ?>

<?php include_once "../home/include/header-home.php"?>

<main>


    <section id="product-details">
        <div class="product-details-container">
            <div class="product-title">
                <h2>Home / <?php echo $category_name; ?> / <?php echo $name; ?></h2>
            </div>
            <div class="product-content">
                <div class="product-images">
                    <?php $count = 0; ?>
                    <?php foreach ($images as $item): ?>
                    <?php if ($count == 0): ?>
                    <div class="main-image">
                        <img src="<?php echo $item['image_path']; ?>"
                            class="<?php echo $count === 0 ? 'active' : ''; ?>" alt="">
                    </div>
                    <?php endif; ?>
                    <?php $count++; ?>
                    <?php endforeach; ?>
                    <div class="thumbnailsContainer">
                        <?php $count = 0; ?>
                        <?php foreach ($images as $item): ?>
                        <?php if ($count < 4): ?>
                        <img id="thumb" src="<?php echo $item['image_path']; ?>" alt="">
                        <?php endif; ?>
                        <?php $count++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>


                <div class="product-info">
                    <h1><?php echo $name; ?></h1>
                    <div class="rateting-details">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <h5>(10)</h5>
                    </div>
                    <h3><?php echo number_format($products["price"], 0, '.', ',') . ' đ'; ?></h3>

                    <label for="quantity">Số lượng:</label>
                    <button class="minus-btn"><i class="fas fa-minus"></i></button>
                    <button class="plus-btn"><i class="fas fa-plus"></i></button>
                    <form id="form-pay" method="post" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $name; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $price; ?>">

                        <?php 
                                $quantity = isset($quantity) ? $quantity : 1;
                                $price = $products['price'];
                            ?>
                        <input type="number" id="quantity" name="quantity" min="1" value="<?php echo $quantity; ?>"
                            data-price="<?php echo $price; ?>" onchange="this.form.submit()">

                        <div class="btn-add-pay">
                            <button id="themvaogio" type="submit" name="add_to_cart"><i
                                    class="fa-solid fa-cart-plus"></i>Thêm Giỏ
                                hàng</button>

                            <button id="muangay" type="submit" name="add_to_cart"><i class="fa-solid fa-check"></i>Mua
                                ngay</button>
                        </div>
                        <label for="description">Mô tả:</label>
                        <p><?php echo $description; ?></p>
                    </form>

                </div>
            </div>
        </div>

        <div class="product-similar">

        </div>
        </div>
    </section>

</main>

<script>
const quantityInput = document.getElementById('quantity');
const minusBtn = document.querySelector('.minus-btn');
const plusBtn = document.querySelector('.plus-btn');

// Lấy giá trị ban đầu của quantityInput
let quantity = parseInt(quantityInput.value);

// Xử lý khi click vào nút trừ
minusBtn.addEventListener('click', () => {
    if (quantity > 1) {
        quantity--;
        quantityInput.value = quantity.toString();
    }
});

// Xử lý khi click vào nút thêm
plusBtn.addEventListener('click', () => {
    quantity++;
    quantityInput.value = quantity.toString();
});







const thumbnails2 = document.querySelectorAll('.thumbnailsContainer img');

function removeActiveClass(selector) {
    const activeElement = document.querySelector(selector + '.active');
    if (activeElement) {
        activeElement.classList.remove('active');
    }
}

thumbnails2.forEach(thumbnail => {
    thumbnail.addEventListener('click', function() {
        removeActiveClass('.main-image img');
        removeActiveClass('.thumbnailsContainer img');

        const imagePath = this.getAttribute('data-image-path');
        const newImage = document.querySelector(`.main-image img[data-image-path="${imagePath}"]`);
        if (newImage) {
            newImage.classList.add('active');
        }
        this.classList.add('active');
    });
});
</script>


<?php include_once "../home/include/footer-home.php"?>