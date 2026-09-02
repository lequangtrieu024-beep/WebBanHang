<?php
include('../../config/config.php');

$ten_danhmuc = $_POST['tendanhmucbaiviet'] ?? '';
$thutu = $_POST['thutu'] ?? '';

if (isset($_POST['themdanhmucbaiviet'])) {

    $sql_them = "INSERT INTO tbl_danhmucbaiviet(tendanhmuc_baiviet, thutu)
                 VALUES ('$ten_danhmuc', '$thutu')";

    mysqli_query($mysqli, $sql_them);

    header('Location:../../index.php?action=quanlydanhmucbaiviet&query=them');
    exit();
}

 // SỬA
 elseif (isset($_POST['suadanhmucbaiviet'])) {
    $id = $_GET['idbaiviet'];

    $sql_update = "UPDATE tbl_danhmucbaiviet
                    SET tendanhmuc_baiviet='$ten_danhmuc', thutu='$thutu'
                    WHERE id_baiviet='$id'";
     mysqli_query($mysqli, $sql_update);

    header('Location:../../index.php?action=quanlydanhmucbaiviet&query=them');
     exit();
 }

// // XÓA
 elseif (isset($_GET['idbaiviet'])) {
    $id = $_GET['idbaiviet'];

    $sql_xoa = "DELETE FROM tbl_danhmucbaiviet WHERE id_baiviet='$id'";
    mysqli_query($mysqli, $sql_xoa);

     header('Location:../../index.php?action=quanlydanhmucbaiviet&query=them');
     exit();
 }
