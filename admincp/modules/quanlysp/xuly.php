<?php
include('../../config/config.php');

// ================= THÊM =================
if (isset($_POST['themsanpham'])) {

    $tensanpham = $_POST['tensanpham'];
    $masp = $_POST['masp'];
    $giasp = $_POST['giasp'];
    $soluong = $_POST['soluong'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $tinhtrang = $_POST['tinhtrang'];
    $danhmuc = $_POST['danhmuc'];

    $hinhanh = '';
    if (!empty($_FILES['hinhanh']['name'])) {
        $hinhanh = time().'_'.$_FILES['hinhanh']['name'];
        move_uploaded_file($_FILES['hinhanh']['tmp_name'], 'uploads/'.$hinhanh);
    }

    $sql = "INSERT INTO tbl_sanpham
    (tensanpham,masp,giasp,soluong,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc)
    VALUES
    ('$tensanpham','$masp','$giasp','$soluong','$hinhanh','$tomtat','$noidung','$tinhtrang','$danhmuc')";

    mysqli_query($mysqli, $sql);
    header('Location:../../index.php?action=quanlysp&query=them');
    exit();
}

// ================= SỬA =================
elseif (isset($_POST['suasanpham'])) {

    $id = $_GET['idsanpham'];

    $tensanpham = $_POST['tensanpham'];
    $masp = $_POST['masp'];
    $giasp = $_POST['giasp'];
    $soluong = $_POST['soluong'];
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

$sql_update = "UPDATE tbl_sanpham SET
    tensanpham='$tensanpham',
    masp='$masp',
    giasp='$giasp',
    soluong='$soluong',
    hinhanh='$hinhanh',
    tomtat='$tomtat',
    noidung='$noidung',
    tinhtrang='$tinhtrang',
    id_danhmuc='$danhmuc'
    WHERE id_sanpham='$id'";


    mysqli_query($mysqli, $sql_update);
    header('Location:../../index.php?action=quanlysp&query=them');
    exit();
}

// ================= XÓA =================
elseif (isset($_GET['idsanpham'])) {

    $id = $_GET['idsanpham'];

    $sql = "SELECT hinhanh FROM tbl_sanpham WHERE id_sanpham='$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($query);

    if (!empty($row['hinhanh'])) {
        unlink('uploads/'.$row['hinhanh']);
    }

    mysqli_query($mysqli, "DELETE FROM tbl_sanpham WHERE id_sanpham='$id'");
    header('Location:../../index.php?action=quanlysp&query=them');
    exit();
}
?>