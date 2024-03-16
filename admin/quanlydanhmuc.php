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
    <div class="content-container">
        <section id="section-quanlydanhmuc">
            <div class="form-qldm">
                <div class="form-qldm-container">
                    <div class="quanlydanhmuc-title">
                        <h2>Danh mục</h2>
                    </div>
                    <div class="quanlydanhmuc-search">
                        <div class="find-all">
                            <i class="fa-solid fa-magnifying-glass" id="search-icon"></i>
                            <input type="search" placeholder="Tìm kiếm danh mục...">
                        </div>
                        <div class="btn-add-category">
                            <i id="icon-edit" class="fa-solid fa-pen-to-square"></i>
                            <button type="button" id="edit-btn" onclick="showEditCategory()">SỬA DANH MỤC</button>
                            <i class="fa-solid fa-plus" id="add-icon"></i>
                            <button type="button" onclick="showAddCategory()">THÊM DANH MỤC</button>
                        </div>
                    </div>
                    <div id="form-add-category">
                        <form id="form-add-qldm" method="POST" action="add_category.php" enctype="multipart/form-data">
                            <h3>Thêm Danh mục mới</h3>
                            <label for="category_name">Tên danh mục:</label><br>
                            <input type="text" id="category_name" name="category_name"><br>
                            <label for="slug">Slug:</label><br>
                            <input type="text" id="slug" name="slug"><br>
                            <label id="choose-file" for="imageInput" class="custom-file-upload"><i
                                    class="fa-solid fa-arrow-up-from-bracket"></i>Thêm ảnh</label>
                            <input type="file" name="imageInput" id="imageInput" onchange="previewImageQLDMAdd(event)">
                            <div id="imagePreviewContainer-qldm"></div>
                            <button type="button" id="cancel_add_category" name="cancel_add_category"
                                onclick="cancelAddCategory()">Trở về</button>
                            <button type="submit" id="add_category" name="add_category"><i
                                    class="fa-solid fa-check"></i>Thêm</button>
                        </form>
                    </div>
                    <form id="form-edit-qldm" method="POST" action="edit_category.php" enctype="multipart/form-data">
                        <h3>Sửa Danh mục</h3>
                        <label for="category_id">ID danh mục:</label><br>
                        <input type="text" id="category_id" name="category_id"
                            value="<?php if(isset($category)) { echo $category['id']; } ?>"><br>
                        <label for="category_name">Tên danh mục:</label><br>
                        <input type="text" id="category_name" name="category_name"
                            value="<?php if(isset($category)) { echo $category['name']; } ?>"><br>
                        <label for="slug">Slug:</label><br>
                        <input type="text" id="slug" name="slug"
                            value="<?php if(isset($category)) { echo $category['slug']; } ?>"><br>
                        <label id="choose-file" for="imageInputEdit" class="custom-file-upload"><i
                                class="fa-solid fa-arrow-up-from-bracket"></i>Hình ảnh mới</label>
                        <input type="file" name="imageInputEdit" id="imageInputEdit"
                            onchange="previewImageQLDMEdit(event)">
                        <div id="imagePreviewContainer-qldm-edit"></div>
                        <button type="button" id="cancel_edit_category" name="cancel_add_category"
                            onclick="cancelEditCategory()">Trở về</button>
                        <button type="submit" id="edit_category" name="edit_category"><i
                                class="fa-solid fa-arrow-up-from-bracket"></i>Cập nhật</button>
                    </form>

                    <div id="confirmDelete">
                        <h3>Bạn có chắc chắn muốn xóa danh mục ?</h3>
                        <h4>Nếu xóa sẽ không thể hồi phục.</h4>
                        <button id="cancel-delete-btn" onclick="cancelDelete()">Trở về</button>
                        <button onclick="deleteCategoryConfirmed()"><i class="fa-regular fa-trash-can"></i>Xóa</button>
                    </div>
                    <div class="table-category">
                        <?php
                            include_once "../config/config.php";
                            
                            // Truy vấn danh sách danh mục từ bảng categories
                            $sql = "SELECT id, name, category_image, slug FROM categories";
                            $result = mysqli_query($conn, $sql);?>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID<i class="fa-solid fa-caret-down"></i></th>
                                    <th>Tên<i class="fa-solid fa-caret-down"></i></th>
                                    <th>Hình ảnh<i class="fa-solid fa-caret-down"></i></th>
                                    <th>Slug<i class="fa-solid fa-caret-down"></i></th>
                                    <th>Thao tác<i class="fa-solid fa-caret-down"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            // Hiển thị dữ liệu lấy được từ cơ sở dữ liệu
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td><img src='../uploads/" . $row["category_image"] . "'></td>";
                                    echo "<td>" . $row["slug"] . "</td>";
                                    echo "<td><button id='actinon-delete-btn' onclick='deleteCategory(" . $row["id"] . ")'><i class='fa-solid fa-trash-can'></i></button></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No categories found.</td></tr>";
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