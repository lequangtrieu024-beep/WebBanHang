<?php
$sql_sua_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[idsanpham]' LIMIT 1";
$query_sua_sp = mysqli_query($mysqli, $sql_sua_sp);
?>

<p class="title">✏️ Sửa sản phẩm</p>

<div class="table-container small">

<?php while($row = mysqli_fetch_array($query_sua_sp)){ ?>

<form method="POST" 
      action="modules/quanlysp/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>" 
      enctype="multipart/form-data">

    <div class="form-group">
        <label>Tên sản phẩm</label>
        <input type="text" name="tensanpham" value="<?php echo $row['tensanpham'] ?>" required>
    </div>

    <div class="form-group">
        <label>Mã sản phẩm</label>
        <input type="text" name="masp" value="<?php echo $row['masp'] ?>" required>
    </div>

    <div class="form-group">
        <label>Giá sản phẩm</label>
        <input type="number" name="giasp" value="<?php echo $row['giasp'] ?>" required>
    </div>

    <div class="form-group">
        <label>Số lượng</label>
        <input type="number" name="soluong" value="<?php echo $row['soluong'] ?>" required>
    </div>

    <div class="form-group">
        <label>Hình ảnh</label>
        <input type="file" name="hinhanh">

        <div style="margin-top:10px">
            <img src="modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" 
                 class="img-preview">
        </div>
    </div>

    <div class="form-group">
        <label>Tóm tắt</label>
        <textarea id="tomtat" name="tomtat"><?php echo $row['tomtat'] ?></textarea>
    </div>

    <div class="form-group">
        <label>Nội dung</label>
        <textarea id="noidung" name="noidung"><?php echo $row['noidung'] ?></textarea>
    </div>

    <div class="form-group">
        <label>Danh mục sản phẩm</label>
        <select name="danhmuc">
            <?php
            $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
            $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
            while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
            ?>
                <option 
                    value="<?php echo $row_danhmuc['id_danhmuc'] ?>"
                    <?php if($row_danhmuc['id_danhmuc']==$row['id_danhmuc']) echo 'selected'; ?>
                >
                    <?php echo $row_danhmuc['tendanhmuc'] ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label>Tình trạng</label>
        <select name="tinhtrang">
            <option value="1" <?php if($row['tinhtrang']==1) echo 'selected'; ?>>✔ Kích hoạt</option>
            <option value="0" <?php if($row['tinhtrang']==0) echo 'selected'; ?>>✖ Ẩn</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" 
               name="suasanpham" 
               class="btn-submit" 
               value="💾 Cập nhật sản phẩm">
    </div>

</form>

<?php } ?>
</div>