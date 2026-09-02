<?php
include('../../config/config.php');

if (isset($_POST['lienhe'])) {

    $thongtinlienhe = $_POST['thongtinlienhe'];

    // kiểm tra có dữ liệu chưa
    $sql_check = "SELECT * FROM tbl_lienhe WHERE id=1";
    $query_check = mysqli_query($mysqli, $sql_check);

    if (mysqli_num_rows($query_check) > 0) {
        // có rồi → UPDATE
        $sql_update = "UPDATE tbl_lienhe 
                       SET thongtinlienhe='$thongtinlienhe' 
                       WHERE id=1";
        mysqli_query($mysqli, $sql_update);
    } else {
        // chưa có → INSERT
        $sql_insert = "INSERT INTO tbl_lienhe(id, thongtinlienhe) 
                       VALUES (1, '$thongtinlienhe')";
        mysqli_query($mysqli, $sql_insert);
    }

    header('Location:../../index.php?action=quanlyweb&query=capnhat');
    exit();
}
?>