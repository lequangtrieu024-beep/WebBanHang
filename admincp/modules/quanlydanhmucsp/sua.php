<?php
$sql_sua_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc = '$_GET[iddanhmuc]' LIMIT 1";
$query_sua_danhmucsp = mysqli_query($mysqli, $sql_sua_danhmucsp);
?>

<p class="title">Sửa Danh Mục Sản Phẩm</p>

<div class="table-container small">
<form method="POST" action="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>">

<?php
while ($dong = mysqli_fetch_array($query_sua_danhmucsp)) {
?>

    <div class="form-group">
        <label>Tên danh mục</label>
        <input 
            type="text" 
            name="tendanhmuc" 
            value="<?php echo $dong['tendanhmuc'] ?>" 
            required
        >
    </div>

    <div class="form-group">
        <label>Thứ tự</label>
        <input 
            type="number" 
            name="thutu" 
            value="<?php echo $dong['thutu'] ?>" 
            required
        >
    </div>

    <div class="form-group">
        <input 
            type="submit" 
            name="suadanhmuc" 
            class="btn-submit" 
            value="💾 Cập nhật danh mục"
        >
    </div>

<?php } ?>

</form>
</div>