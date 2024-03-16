<?php include_once "../admin/include/header-admin.php"; ?>

<?php include_once "../admin/include/sidebar-admin.php"; ?>

<?php include_once "../admin/include/footer-admin.php"; ?>

<article>
    <section id="section-quanlysanpham">
        <div class="add-product-container">
            <form id="qlsp-form" action="add_product.php" method="post" enctype="multipart/form-data">
                <h1>Thêm sản phẩm mới</h1>
                <h2>Hình ảnh</h2>
                <label id="choose-file" for="imageInput" class="custom-file-upload"><i
                        class="fa-solid fa-arrow-up-from-bracket"></i>Thêm ảnh</label>
                <input type="file" name="images[]" id="imageInput" multiple onchange="previewImageProduct(event)">
                <div id="imagePreviewContainer"></div>
                <h2>Thông tin</h2>
                <label for="name">Danh mục</label>
                <select name="category_slug" id="category_slug">
                    <?php
                                        // Lấy danh sách các danh mục từ database
                                        $sql = "SELECT * FROM categories";
                                        $result = mysqli_query($conn, $sql);
            
                                        // Hiển thị danh sách các danh mục dưới dạng các tùy chọn trong thẻ select
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['slug'] . '">' . $row['name'] . '</option>';
                                        }
                                        ?>
                </select>
                </br>
                <label for="name">Tên</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Điền tên sản phẩm..."
                    required>
                <label for="description">Mô tả</label>
                <textarea class="form-control" id="description" name="description" placeholder="Điền mô tả sản phẩm..."
                    required></textarea>
                <label for="price">Giá</label>
                <input type="text" class="form-control" id="price-input" name="price" min="0"
                    placeholder="Điền giá sản phẩm..." required>
                <div class="btn-add-or-discard">
                    <button type="submit" id="btn-discard" class="btn btn-primary">Không lưu</button>
                    <button type="submit" id="btn-add" class="btn btn-primary">Thêm</button>
                </div>
            </form>

            <form id="qlsp-edit-form" action="edit_product.php" method="post" enctype="multipart/form-data">
                <h1>Chỉnh sửa sản phẩm</h1>
                <label for="id">ID</label>
                <input type="text" class="form-control" id="id" name="product_id" placeholder="Điền ID sản phẩm"
                    required>
                <h2>Hình ảnh mới</h2>
                <label id="choose-file" for="imageInputEdit" class="custom-file-upload"><i
                        class="fa-solid fa-arrow-up-from-bracket"></i>Thêm ảnh</label>
                <input type="file" id="imageInputEdit" name="images[]" multiple onchange="previewImageQLSPEdit(event)">
                <div id="imagePreviewContainer-qlsp-edit"></div>
                <h2>Thông tin</h2>
                <label for="product_slug">Danh mục</label>
                <select name="category_slug" id="category_slug">
                    <?php
                                        // Lấy danh sách các danh mục từ database
                                        $sql = "SELECT * FROM categories";
                                        $result = mysqli_query($conn, $sql);
            
                                        // Hiển thị danh sách các danh mục dưới dạng các tùy chọn trong thẻ select
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['slug'] . '">' . $row['name'] . '</option>';
                                        }
                                        ?>
                </select>
                </br>
                <label for="product_name">Tên</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    placeholder="Điền tên sản phẩm..." required>
                <label for="product_description">Mô tả</label>
                <textarea class="form-control" id="product_description" name="product_description"
                    placeholder="Điền mô tả sản phẩm..." required></textarea>
                <label for="product_price">Giá</label>
                <input type="number" class="form-control" id="price-input" name="product_price" min="1000"
                    placeholder="Điền giá sản phẩm..." required>
                <div class="btn-add-or-discard">
                    <button type="submit" id="btn-discard" class="btn btn-primary" onclick="cancelEditProduct()">Không
                        lưu</button>
                    <button type="submit" id="btn-edit" class="btn btn-primary">Lưu</button>
                </div>


            </form>

        </div>
        <div class="list-product-container">
            <div class="list-title">
                <h2>Danh sách Sản phẩm</h2>
                <div class="list-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search">
                </div>
                <div class="list-btn">
                    <button type="submit" onclick="showEditProduct()">Chỉnh sửa Sản phẩm</button>
                </div>
            </div>
            <div class="list-product-show">


                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Giá</th>
                            <th>Mô tả</th>
                            <th>Th.tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once "../config/config.php";
                            
                            // Truy vấn danh sách danh mục từ bảng categories
                            $sql = "SELECT id, name, price, description, category_id FROM products";
                            $result = mysqli_query($conn, $sql);
                            
                            // Hiển thị dữ liệu lấy được từ cơ sở dữ liệu
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>";
                                        // Lấy ảnh đầu tiên của sản phẩm từ cơ sở dữ liệu
                                        $image_query = "SELECT image_path FROM product_images WHERE product_id=" . $row["id"] . " LIMIT 1";
                                        $image_result = mysqli_query($conn, $image_query);
                                        if ($image_result->num_rows > 0) {
                                            $image_row = $image_result->fetch_assoc();
                                            echo "<img id='image_path' src='" . $image_row["image_path"] . "'>";
                                        } else {
                                            // Hiển thị hình ảnh mặc định nếu sản phẩm không có ảnh
                                            echo "<img src='/default-product-image.jpg'>";
                                        }
                                        echo "</td>";
                                    echo "<td>" .number_format($row["price"], 0, '.', ',') . ' đ'. "</td>";
                                    echo "<td>" . $row["description"] . "</td>";
                                    echo "<td><button id='actinon-delete-btn' onclick='deleteProduct(" . $row["id"] . ")'><i class='fa-solid fa-trash-can'></i></button></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No categories found.</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div id="confirmDelete">
                <h3>Bạn có chắc chắn muốn xóa sản phẩm ?</h3>
                <h4>Nếu xóa sẽ không thể phục hồi.</h4>
                <button id="cancel-delete-btn" onclick="cancelDelete()">Trở về</button>
                <button type="submit" onclick="deleteProductConfirmed()"><i
                        class="fa-regular fa-trash-can"></i>Xóa</button>
            </div>
        </div>
    </section>
</article>