<?php
include('../../config/config.php');

// ================= THÊM =================
if (isset($_POST['thembaiviet'])) {
    $tenbaiviet = $_POST['tenbaiviet'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $tinhtrang = $_POST['tinhtrang'];
    $danhmuc = $_POST['danhmuc'];

    $hinhanh = '';
    if (!empty($_FILES['hinhanh']['name'])) {
        $hinhanh = time().'_'.$_FILES['hinhanh']['name'];
        move_uploaded_file($_FILES['hinhanh']['tmp_name'], 'uploads/'.$hinhanh);
    }

   $sql = "INSERT INTO tbl_baiviet
(tenbaiviet, hinhanh, tomtat, noidung, tinhtrang, id_danhmuc)
VALUES
('$tenbaiviet','$hinhanh','$tomtat','$noidung','$tinhtrang','$danhmuc')";

    mysqli_query($mysqli, $sql);
    header('Location:../../index.php?action=quanlybaiviet&query=them');
    exit();
}

// // ================= SỬA =================
elseif (isset($_POST['suabaiviet'])) {

    $id = $_GET['idbaiviet'];

    $tenbaiviet = $_POST['tenbaiviet'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $tinhtrang = $_POST['tinhtrang'];
   $danhmuc = $_POST['danhmuc'];


   if (!empty($_FILES['hinhanh']['name'])) {

    // upload ảnh mới
    $hinhanh = time().'_'.$_FILES['hinhanh']['name'];
    move_uploaded_file($_FILES['hinhanh']['tmp_name'], 'uploads/'.$hinhanh);

    // xóa ảnh cũ
    if (!empty($hinhanh_cu)) {
        unlink('uploads/'.$hinhanh_cu);
    }

} else {
    // giữ ảnh cũ
    $hinhanh = $hinhanh_cu;
}

$sql_update = "UPDATE tbl_baiviet SET
    tenbaiviet='$tenbaiviet',
    hinhanh='$hinhanh',
    tomtat='$tomtat',
    noidung='$noidung',
    tinhtrang='$tinhtrang',
    id_danhmuc='$danhmuc'
    WHERE id='$id'";


    mysqli_query($mysqli, $sql_update);
    header('Location:../../index.php?action=quanlybaiviet&query=them');
    exit();
}

// ================= XÓA =================
elseif (isset($_GET['idbaiviet'])) {

    $id = $_GET['idbaiviet'];

    $sql = "SELECT hinhanh FROM tbl_baiviet WHERE id='$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($query);

    if (!empty($row['hinhanh'])) {
        unlink('uploads/'.$row['hinhanh']);
    }

    mysqli_query($mysqli, "DELETE FROM tbl_baiviet WHERE id='$id'");
    header('Location:../../index.php?action=quanlybaiviet&query=them');
    exit();
}
?>