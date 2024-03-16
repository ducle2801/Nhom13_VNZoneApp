function changeTypePassword() {
    document.getElementById('password').type = document.getElementById('password').type === 'text' ? 'password' : 'text';
}
function changeTypePassword2() {
    document.getElementById('confirm_password').type = document.getElementById('confirm_password').type === 'text' ? 'password' : 'text';
}
function signup() {
    var fullname = document.getElementById("fullname").value;
    var email = document.getElementById("email").value;
    var address = document.getElementById("address").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;
    var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/;

    if (fullname == null || fullname == "") {
        alert("Vui lòng nhập tên đầy đủ");
        return false;
    }

    if (email == null || email == "") {
        alert("Vui lòng nhập địa chỉ email");
        return false;
    } else if (emailReg.test(email) == false) {
        alert("Địa chỉ email không hợp lệ");
        return false;
    }

    if (address == null || address == "") {
        alert("Vui lòng nhập địa chỉ");
        return false;
    }

    if (username == null || username == "") {
        alert("Vui lòng nhập tên đăng nhập");
        return false;
    }

    if (password == "" || password.length < 8) {
        alert("Mật khẩu phải có ít nhất 8 ký tự");
        return false;
    }

    if (confirm_password == "" || confirm_password.length < 8) {
        alert("Mật khẩu không khớp");
        return false;
    }

    // Không chuyển hướng đến trang "login.php" khi thông tin nhập không hợp lệ
    // alert("Đăng ký thành công!");
    return true;

}