<?php
session_start();
include('../../admincp/config/config.php');
require('../../Carbon/Carbon-3.11.1/autoload.php');

use Carbon\Carbon;

// ===== THỜI GIAN =====
$now = Carbon::now('Asia/Ho_Chi_Minh');
$today = $now->toDateString();       // 2026-03-11
$time = $now->toDateTimeString();    // 2026-03-11 18:00:00

$id_khachhang = $_SESSION['id_khachhang'];
$code_order = time(); 
$cart_payment = $_POST['payment'];


// ===== LẤY SHIPPING =====
$sql_get_vanchuyen = mysqli_query($mysqli,
"SELECT * FROM tbl_shipping WHERE id_dangky='$id_khachhang' LIMIT 1");

$row = mysqli_fetch_array($sql_get_vanchuyen);
$id_shipping = $row['id_shipping'];


// ===== INSERT ĐƠN HÀNG =====
$insert_cart = "INSERT INTO tbl_cart
(id_khachhang,code_cart,cart_status,cart_date,cart_payment,cart_shipping)
VALUES
('$id_khachhang','$code_order','1','$time','$cart_payment','$id_shipping')";

$cart_query = mysqli_query($mysqli,$insert_cart);


if($cart_query){

    $tongtien = 0;
    $soluongban = 0;

    foreach($_SESSION['cart'] as $value){

        $id_sanpham = $value['id'];
        $soluong = $value['soluong'];
        $giasp = $value['giasp'];

        $thanhtien = $soluong * $giasp;

        $tongtien += $thanhtien;
        $soluongban += $soluong;


        // ===== INSERT CHI TIẾT ĐƠN =====
        mysqli_query($mysqli,"
        INSERT INTO tbl_cart_details(id_sanpham,code_cart,soluongmua)
        VALUES('$id_sanpham','$code_order','$soluong')
        ");


        // ===== TRỪ SỐ LƯỢNG KHO =====
        $sql_chitiet = mysqli_query($mysqli,
        "SELECT soluong FROM tbl_sanpham WHERE id_sanpham='$id_sanpham' LIMIT 1");

        $row_sp = mysqli_fetch_array($sql_chitiet);

        $soluongcon = $row_sp['soluong'] - $soluong;

        mysqli_query($mysqli,"
        UPDATE tbl_sanpham 
        SET soluong='$soluongcon'
        WHERE id_sanpham='$id_sanpham'
        ");
    }


    // ===== THỐNG KÊ =====

    $sql_thongke = mysqli_query($mysqli,
    "SELECT * FROM tbl_thongke WHERE DATE(ngaydat)='$today' LIMIT 1");

    if(mysqli_num_rows($sql_thongke) == 0){

        mysqli_query($mysqli,"
        INSERT INTO tbl_thongke(ngaydat,donhang,doanhthu,soluongban)
        VALUES('$today',1,'$tongtien','$soluongban')
        ");

    }else{

        $row = mysqli_fetch_array($sql_thongke);

        $donhang = (int)$row['donhang'] + 1;
        $doanhthu = (int)$row['doanhthu'] + $tongtien;
        $soluongban_new = (int)$row['soluongban'] + $soluongban;

        mysqli_query($mysqli,"
        UPDATE tbl_thongke
        SET donhang='$donhang',
            doanhthu='$doanhthu',
            soluongban='$soluongban_new'
        WHERE DATE(ngaydat)='$today'
        ");
    }
}


// ===== XÓA GIỎ HÀNG =====
unset($_SESSION['cart']);


// ===== CHUYỂN TRANG =====
header('Location:../../index.php?quanly=camon');
exit();
?>