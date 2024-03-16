<?php
    // Kết nối đến CSDL
    require_once '../config/config.php';
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

                <?php 
                // Kiểm tra xem giá trị 'keyword' đã được gửi hay chưa
                if(isset($_GET['keyword'])){
                $keyword = $_GET['keyword'];

                // Truy vấn SQL để tìm kiếm
                $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%'";
                $result = mysqli_query($conn, $sql);
    
                // Hiển thị kết quả tìm kiếm
                if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="product-details">
                    <li>
                        <a href="product_detail.php?id=<?php echo $row['id']; ?>">
                            <span>Giảm 50%</span>

                            <?php 
                $image_query = "SELECT image_path FROM product_images WHERE product_id=" . $row["id"] . " LIMIT 1";
                $image_result = mysqli_query($conn, $image_query);
                if ($image_result->num_rows > 0) {
                    $image_row = $image_result->fetch_assoc();?>
                            <img id="image_path" src="<?php echo $image_row['image_path']; ?>">
                            <?php }else { ?>
                            <img src='/default-product-image.jpg'>";
                            <?php } ?>

                            <h3><?php echo $row['name']; ?></h3>
                            <h4><?php echo number_format($row["price"], 0, '.', ',') . ' đ'; ?></h4>
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

                <?php } else {
                    echo 'Không tìm thấy kết quả phù hợp.';
                }
                } else {
                    echo 'Vui lòng nhập từ khóa tìm kiếm.';
                }
            ?>

            </div>
        </ul>

    </section>

</main>

<?php include_once "../home/include/footer-home.php"?>