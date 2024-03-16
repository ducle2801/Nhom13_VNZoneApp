<?php require_once "../config/config.php" ?>

<?php include_once "../home/include/header-home.php"?>

<main>
    <section id="fashion-banner">
        <div class="list-category-container">
            <div class="list-category">
                <?php
                    $sql = "SELECT * FROM categories";
                    $result = $conn->query($sql);
 
                    if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<ul>";
                                echo "<li><a href='category.php?id=".$row['id']."'>" . $row["name"] . "<i class='fa-solid fa-angle-right'></i></a></li>";
                                echo "</ul>";
                            }
                        } else {
                            echo "Không có danh mục nào.";
                    }
                ?>
            </div>
        </div>
        <div class="banner-container">
            <div class="banner-left">
                <img src="../home/assets/images/Home/qc1.png" alt="">
                <img src="../home/assets/images/Home/qc2.png" alt="">
                <img src="../home/assets/images/Home/qc3.png" alt="">
            </div>
            <div class="banner-right">
                <div class="banner-right-top">
                    <img src="../home/assets/images/Home/banner1.png" alt="">
                </div>
                <div class="banner-right-bottom">
                    <img src="../home/assets/images/Home/banner2.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="introduce">
        <div class="all-intro">
            <div class="details-intro">
                <div class="intro-icon">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <div class="intro-title">
                    <h2>Miễn phí ship</h2>
                    <p>Mua sắm thoải mái</p>
                </div>
            </div>

            <div class="details-intro">
                <div class="intro-icon">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div class="intro-title">
                    <h2>Hổ trợ 24/7</h2>
                    <p>Luôn luôn lắng nghe</p>
                </div>
            </div>

            <div class="details-intro">
                <div class="intro-icon">
                    <i class="fa-solid fa-money-bill"></i>
                </div>
                <div class="intro-title">
                    <h2>Hoàn tiền 100%</h2>
                    <p>Có 30 ngày hoàn tiền</p>
                </div>
            </div>

            <div class="details-intro">
                <div class="intro-icon">
                    <i class="fa-solid fa-credit-card"></i>
                </div>
                <div class="intro-title">
                    <h2>Thanh toán an toàn</h2>
                    <p>Nhanh chóng và bảo mật</p>
                </div>
            </div>
        </div>
    </section>

    <section id="product-for-you">
        <div class="all-product-title">
            <h2>Product For You</h2>
        </div>
        <div class="all-product">

            <?php
                    // Số trang hiện tại
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    // Số bản ghi trên một trang
                    $records_per_page = 12;
                    // Vị trí bắt đầu của bản ghi trong truy vấn
                    $offset = ($current_page - 1) * $records_per_page;
                    $sql = "SELECT p.id, p.name, p.price, i.image_path 
                        FROM products p 
                        LEFT JOIN product_images i ON p.id = i.product_id 
                        GROUP BY p.id 
                        ORDER BY p.created_at 
                        LIMIT $offset, $records_per_page;";

                    $result = mysqli_query($conn, $sql);
            ?>
            <?php
                        while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-details">
                <li>
                    <a href="product_detail.php?id=<?php echo $row['id']; ?>">
                        <span>Giảm 50%</span>
                        <img src="<?php echo $row['image_path']; ?>" alt="">
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
            <?php }?>

        </div>

        <?php // Tạo nút phân trang
                $sql = "SELECT COUNT(*) AS total FROM products";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $total_records = $row['total'];

                $total_pages = ceil($total_records / $records_per_page); ?>
        <div class='number-page-product'>
            <a href="" class="prev"><i class="fa-solid fa-angle-left"></i></a>
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <?php if ($i == $current_page) { ?>
            <a href="?page=<?php echo $i ?>" class="active"><?php echo $i ?></a>
            <?php } else { ?>
            <a href="?page=<?php echo $i ?>"><?php echo $i ?></a>
            <?php } ?>
            <?php } ?>
            <a href="" class="next"><i class="fa-solid fa-angle-right"></i></a>
        </div>
    </section>

</main>

<script>
var slideIndex = 0;
var slides = document.getElementsByClassName("banner-left")[0].getElementsByTagName("img");

function showSlide() {
    for (var i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].classList.add("active");
    setTimeout(showSlide, 2000);
}

showSlide();
</script>

<?php include_once "../home/include/footer-home.php"?>