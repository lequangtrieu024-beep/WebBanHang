<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href ="css/styleadmincp.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <title>Admincp</title>

    <!-- Chuyển JS lên đây -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<?php
session_start();
if(!isset($_SESSION['dangnhap'])){
    header('Location:login.php');
}
?>

<body>

<?php include("config/config.php"); ?>

<div class="wrapper">
    <?php include("modules/menu.php"); ?>

    <div class="main-content">
        <?php include("modules/header.php"); ?>
        <?php include("modules/main.php"); ?>
    </div>
</div>

<?php include("modules/footer.php"); ?>

<!-- Chỉ còn lại CKEditor init ở cuối -->
<script>
CKEDITOR.config.versionCheck = false;
CKEDITOR.replace('tomtat');
CKEDITOR.replace('noidung');
CKEDITOR.replace('thongtinlienhe');
</script>

</body>
</html>