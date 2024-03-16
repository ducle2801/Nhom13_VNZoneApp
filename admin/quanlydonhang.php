<?php include_once "../admin/include/header-admin.php"; ?>

<?php include_once "../admin/include/sidebar-admin.php"; ?>

<?php include_once "../admin/include/footer-admin.php"; ?>

<?php
// Kiểm tra session
session_start();
if (isset($_SESSION['success_msg'])) {
  // Hiển thị thông báo thành công
  echo '<p style="color: green;">' . $_SESSION['success_msg'] . '</p>';
  
  // Xóa thông báo thành công khỏi session
  unset($_SESSION['success_msg']);
}
?>


<article>
    <div class="content-container1">
        <section id="section-quanlydanhmuc">
            <div class="form-qldm">
                <div class="form-qldm-container">
                    <div class="quanlydanhmuc-title">
                        <h2>Đơn hàng</h2>
                    </div>
                    <div class="quanlydanhmuc-search">
                        <div class="find-all">
                            <i class="fa-solid fa-magnifying-glass" id="search-icon"></i>
                            <input type="search" placeholder="Tìm kiếm đơn hàng...">
                        </div>
                    </div>
                    <div class="table-category">
                        <?php
                            include_once "../config/config.php";
                            
                            // Truy vấn danh sách danh mục từ bảng categories
                            $sql = "SELECT id, customer_name, phone, email, total_price, status FROM orders";
                            $result = mysqli_query($conn, $sql);?>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID<i class="fa-solid fa-caret-down"></i></th>
                                    <th>Tên khách hàng<i class="fa-solid fa-caret-down"></i></th>
                                    <th>Số điện thoại<i class="fa-solid fa-caret-down"></i></th>
                                    <th>Email<i class="fa-solid fa-caret-down"></i></th>
                                    <th>Tổng tiền<i class="fa-solid fa-caret-down"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            // Hiển thị dữ liệu lấy được từ cơ sở dữ liệu
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["customer_name"] . "</td>";
                                    echo "<td>" . $row["phone"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "<td>" . number_format($row["total_price"], 0, '.', ',') . ' đ' . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>Không có đơn hàng nào.</td></tr>";
                            }
                        ?>
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </section>
    </div>
</article>