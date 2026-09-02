<?php
$sql_sua_danhmucbv = "SELECT * FROM tbl_danhmucbaiviet WHERE id_baiviet = '$_GET[idbaiviet]' LIMIT 1";
$query_sua_danhmucbv = mysqli_query($mysqli, $sql_sua_danhmucbv);
?>

<p class="title">✏️ Sửa danh mục bài viết</p>

<div class="table-container small">

<?php while ($dong = mysqli_fetch_array($query_sua_danhmucbv)) { ?>

<form method="POST" 
      action="modules/quanlydanhmucbaiviet/xuly.php?iddanhmuc=<?php echo $dong['id_baiviet'] ?>">

    <div class="form-group">
        <label>Tên danh mục bài viết</label>
        <input 
            type="text" 
            name="tendanhmucbaiviet" 
            value="<?php echo $dong['tendanhmuc_baiviet'] ?>" 
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
            name="suadanhmucbaiviet" 
            class="btn-submit" 
            value="💾 Cập nhật danh mục"
            onclick="return confirm('Bạn có chắc muốn cập nhật không?')"
        >
    </div>

</form>

<?php } ?>

</div>