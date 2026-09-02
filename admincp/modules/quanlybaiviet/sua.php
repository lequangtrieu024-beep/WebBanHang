<?php
$id = intval($_GET['idbaiviet']);

$sql_sua_bv = "SELECT * FROM tbl_baiviet WHERE id = $id LIMIT 1";
$query_sua_bv = mysqli_query($mysqli, $sql_sua_bv);
?>

<p class="title">✏️ Sửa bài viết</p>

<div class="table-container small">

<?php while($row = mysqli_fetch_array($query_sua_bv)){ ?>

<form method="POST" 
      action="modules/quanlybaiviet/xuly.php?idbaiviet=<?php echo $row['id'] ?>" 
      enctype="multipart/form-data">

    <div class="form-group">
        <label>Tên bài viết</label>
        <input type="text" name="tenbaiviet" 
               value="<?php echo $row['tenbaiviet'] ?>" required>
    </div>

    <div class="form-group">
        <label>Hình ảnh</label>
        <input type="file" name="hinhanh">

        <div class="preview-box">
            <img src="modules/quanlybaiviet/uploads/<?php echo $row['hinhanh']; ?>">
        </div>
    </div>

    <div class="form-group">
        <label>Tóm tắt</label>
        <textarea name="tomtat"><?php echo $row['tomtat'] ?></textarea>
    </div>

    <div class="form-group">
        <label>Nội dung</label>
        <textarea name="noidung"><?php echo $row['noidung'] ?></textarea>
    </div>

   <div class="form-group">
        <label>Danh mục bài viết</label>
        <select name="danhmuc">
            <?php
            $sql_danhmuc = "SELECT * FROM tbl_danhmucbaiviet ORDER BY id_baiviet DESC";
            $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
            while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
            ?>
                <option value="<?php echo $row_danhmuc['id_baiviet'] ?>">
                    <?php echo $row_danhmuc['tendanhmuc_baiviet'] ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label>Tình trạng</label>
        <select name="tinhtrang">
            <option value="1" <?php if($row['tinhtrang']==1) echo 'selected'; ?>>
                ✔ Kích hoạt
            </option>
            <option value="0" <?php if($row['tinhtrang']==0) echo 'selected'; ?>>
                ✖ Ẩn
            </option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" name="suabaiviet"  class="btn-submit" value="💾 Cập nhật bài viết">
    </div>

</form>

<?php } ?>

</div>