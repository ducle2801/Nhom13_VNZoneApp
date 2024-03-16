// Hàm thực hiện đăng xuất người dùng
function dangXuat() {
      // Gọi đến trang logout.php để xóa session
      window.location.href = "logout.php";
}

// Hàm hiển thị div xác nhận
function showDeleteConfirmation() {
  document.getElementById('confirmDelete').style.display = 'block';
}

// Hàm ẩn div xác nhận
function hideDeleteConfirmation() {
  document.getElementById('confirmDelete').style.display = 'none';
}

// Hàm ẩn div xác nhận khi người dùng nhấn nút "Không"
function cancelDelete() {
  hideDeleteConfirmation();
}


function deleteCategory(id) {
      // Hiển thị div xác nhận
  showDeleteConfirmation();

  // Lưu id của danh mục để xóa
  var categoryId = id;

  // Hàm xử lý khi người dùng xác nhận xóa danh mục
  window.deleteCategoryConfirmed = function() {
    // Tạo đối tượng XMLHttpRequest để gửi yêu cầu tới file PHP xử lý xóa danh mục
    var xhttp = new XMLHttpRequest();
        
        // Định nghĩa hàm xử lý kết quả trả về
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            // Hiển thị thông báo về kết quả trả về từ file PHP xử lý
            console.log(this.responseText);
    
            // Reload trang web để cập nhật danh sách danh mục
            location.reload();
          }
        };
    
        // Gửi yêu cầu tới file PHP xử lý xóa danh mục
        xhttp.open("GET", "delete_category.php?id=" + id, true);
        xhttp.send();
      }
    }
    


    function showAddCategory() {
      document.getElementById("form-add-category").style.display = "block";
    }
    
    function cancelAddCategory() {
      document.getElementById("form-add-category").style.display = "none";
    }

    function showEditCategory() {
      document.getElementById("form-edit-qldm").style.display = "block";
    }

    function cancelEditCategory() {
      document.getElementById("form-edit-qldm").style.display = "none";
    }

    function showEditProduct() {
      document.getElementById("qlsp-edit-form").style.display = "block";
    }

    function cancelEditProduct() {
      document.getElementById("qlsp-edit-form").style.display = "none";
    }


    

    function previewImageProduct(event) {
      const imageInput = event.target;
      const imagePreviewContainer = document.getElementById('imagePreviewContainer');
      imagePreviewContainer.innerHTML = '';
      
      for (let i = 0; i < imageInput.files.length; i++) {
        const file = imageInput.files[i];
        const reader = new FileReader();
        reader.onload = function() {
          const img = document.createElement('img');
          img.setAttribute('src', reader.result);
          imagePreviewContainer.appendChild(img);
        }
        reader.readAsDataURL(file);
      }
    }

    function previewImageQLDMAdd(event) {
      const imageInput = event.target;
      const imagePreviewContainer = document.getElementById('imagePreviewContainer-qldm');
      imagePreviewContainer.innerHTML = '';
      
      for (let i = 0; i < imageInput.files.length; i++) {
        const file = imageInput.files[i];
        const reader = new FileReader();
        reader.onload = function() {
          const img = document.createElement('img');
          img.setAttribute('src', reader.result);
          imagePreviewContainer.appendChild(img);
        }
        reader.readAsDataURL(file);
      }
    }
    

    function previewImageQLDMEdit(event) {
      const imageInput = event.target;
      const imagePreviewContainer = document.getElementById('imagePreviewContainer-qldm-edit');
      imagePreviewContainer.innerHTML = '';
      
      for (let i = 0; i < imageInput.files.length; i++) {
        const file = imageInput.files[i];
        const reader = new FileReader();
        reader.onload = function() {
          const img = document.createElement('img');
          img.setAttribute('src', reader.result);
          imagePreviewContainer.appendChild(img);
        }
        reader.readAsDataURL(file);
      }
    }

    function previewImageQLSPEdit(event) {
      const imageInput = event.target;
      const imagePreviewContainer = document.getElementById('imagePreviewContainer-qlsp-edit');
      imagePreviewContainer.innerHTML = '';
      
      for (let i = 0; i < imageInput.files.length; i++) {
        const file = imageInput.files[i];
        const reader = new FileReader();
        reader.onload = function() {
          const img = document.createElement('img');
          img.setAttribute('src', reader.result);
          imagePreviewContainer.appendChild(img);
        }
        reader.readAsDataURL(file);
      }
    }






        // Hàm hiển thị div xác nhận
function showDeleteConfirmation() {
  document.getElementById('confirmDelete').style.display = 'block';
}

// Hàm ẩn div xác nhận
function hideDeleteConfirmation() {
  document.getElementById('confirmDelete').style.display = 'none';
}

// Hàm ẩn div xác nhận khi người dùng nhấn nút "Không"
function cancelDelete() {
  hideDeleteConfirmation();
}
    

function deleteProduct(id) {
  // Lưu id của sản phẩm để xóa
  var productId = id;

  // Hiển thị div xác nhận
  showDeleteConfirmation();

  // Gán hàm xác nhận xóa sản phẩm cho biến window.deleteProductConfirmed
  window.deleteProductConfirmed = function() {
    // Tạo đối tượng XMLHttpRequest để gửi yêu cầu tới file PHP xử lý xóa sản phẩm
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        location.reload();
      }
    };
    xhttp.open("POST", "delete_product.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + productId);
  };
}




    const editProductBtns = document.querySelectorAll('.edit-product-btn');
    const editForm = document.querySelector('#qlsp-edit-form');

    editProductBtns.forEach(editProductBtn => {
        editProductBtn.addEventListener('click', () => {
            // Lấy ID sản phẩm được chọn
            const productId = editProductBtn.getAttribute('data-id');

            // Gọi AJAX để lấy dữ liệu sản phẩm từ server
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `get_product.php?id=${productId}`, true);
            xhr.onload = () => {
                if (xhr.status === 200) {
                    // Parse dữ liệu JSON trả về từ server
                    const product = JSON.parse(xhr.responseText);

                    // Điền dữ liệu vào các trường của form edit
                    editForm.querySelector('#id').value = product.id;
                    editForm.querySelector('#category').value = product.category_id;
                    editForm.querySelector('#product_name').value = product.name;
                    editForm.querySelector('#product_description').value = product.description;
                    editForm.querySelector('#price-input').value = product.price;

                    // Hiển thị form edit
                    editForm.style.display = 'block';
                } else {
                    alert('Error loading product data');
                }
            }
            xhr.send();
        });
    });



    



    







