<?php
session_start();

// Xóa toàn bộ session
session_unset();
session_destroy();

// quay về trang chủ
header("Location: index.php");
exit();
?>