<?php
    // Kết nối đến CSDL
    require_once '../config/config.php';

    // Lấy danh sách sản phẩm trong danh mục
    $category_id = $_GET['id'];
    $query = "SELECT * FROM products WHERE category_id = '$category_id'";
    $products = mysqli_query($conn, $query);
?>

<?php include_once "../home/include/header-home.php"?>

<main>

    <section id="product-for-you">
        <div class="all-product-title">
            <h2>All Product</h2>
        </div>

        <!-- Hiển thị danh sách sản phẩm trong danh mục -->
        <ul>

            <div class="all-product">

                <?php while ($product = mysqli_fetch_assoc($products)): ?>
                <div class="product-details">
                    <li>
                        <a href="product_detail.php?id=<?php echo $product['id']; ?>">
                            <span>Giảm 50%</span>

                            <?php 
                $image_query = "SELECT image_path FROM product_images WHERE product_id=" . $product["id"] . " LIMIT 1";
                $image_result = mysqli_query($conn, $image_query);
                if ($image_result->num_rows > 0) {
                    $image_row = $image_result->fetch_assoc();?>
                            <img id="image_path" src="<?php echo $image_row['image_path']; ?>">
                            <?php }else { ?>
                            <img src='/default-product-image.jpg'>";
                            <?php } ?>

                            <h3><?php echo $product['name']; ?></h3>
                            <h4><?php echo number_format($product["price"], 0, '.', ',') . ' đ'; ?></h4>
                            <div class="rateting">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <h5>(10)</h5>
                            </div>
                        </a>
                    </li>
                    <a id="chitiet" href="product_detail.php?id=<?php echo $row['id']; ?>">Chi tiết</a>
                </div>
                <?php endwhile; ?>

            </div>
        </ul>

    </section>

</main>

<?php include_once "../home/include/footer-home.php"?>