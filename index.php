<?php
// Kiểm tra nếu yêu cầu trang admin
if (isset($_GET['admin']) && $_GET['admin'] == true && $_SERVER['REQUEST_METHOD'] == 'GET' && empty($_POST)) {
  // Chuyển hướng đến trang admin
  header('Location: admin/');
  exit();
} else {
  // Chuyển hướng đến trang home
  header('Location: home/');
  exit();
}
?>