// Hàm thực hiện đăng xuất người dùng
function dangXuat() {
      // Gọi đến trang logout.php để xóa session
      window.location.href = "./logout.php";
}

// Lấy các phần tử DOM của các nút
var prevButton = document.querySelector('.number-page-product .prev');
var nextButton = document.querySelector('.number-page-product .next');

// Thêm sự kiện click cho nút prev
prevButton.addEventListener('click', function(event) {
  event.preventDefault();
  // Thực hiện chuyển tới trang trước đó
  window.history.back();
});

// Thêm sự kiện click cho nút next
nextButton.addEventListener('click', function(event) {
  event.preventDefault();
  // Thực hiện chuyển tới trang tiếp theo
  window.history.forward();
});


// Lấy tất cả các ảnh nhỏ
var thumbnails = document.querySelectorAll('.thumbnails img');

// Lặp lại các ảnh nhỏ và thêm sự kiện click vào từng ảnh
thumbnails.forEach(function(thumbnail) {
  thumbnail.addEventListener('click', function() {
    // Lấy đường dẫn ảnh lớn từ thuộc tính "src" của ảnh nhỏ được click
    var largeImageSrc = this.src.replace('thumbnail', 'large-image');

    // Tìm ảnh đại diện và thay đổi đường dẫn ảnh thành đường dẫn ảnh lớn
    var mainImage = document.querySelector('.main-image img');
    mainImage.src = largeImageSrc;

    // Đặt lớp "active" cho ảnh nhỏ được click và loại bỏ lớp "active" từ tất cả các ảnh nhỏ khác
    thumbnails.forEach(function(thumbnail) {
      thumbnail.classList.remove('active');
    });
    this.classList.add('active');
  });
});


document.addEventListener('DOMContentLoaded', function() {
  let minusButton = document.querySelector('.minus-btn');
  let plusButton = document.querySelector('.plus-btn');
  let quantityInput = document.querySelector('#quantity');

  minusButton.addEventListener('click', function() {
    if (quantityInput.value > parseInt(quantityInput.min)) {
      quantityInput.value = parseInt(quantityInput.value) - 1;
    }
  });

  plusButton.addEventListener('click', function() {
    if (quantityInput.value < parseInt(quantityInput.max)) {
      quantityInput.value = parseInt(quantityInput.value) + 1;
    }
  });
});









