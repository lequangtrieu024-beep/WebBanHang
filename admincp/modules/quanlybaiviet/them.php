<p class="title">Thêm bài viết</p>

<div class="table-container small">
<form method="POST" action="modules/quanlybaiviet/xuly.php" enctype="multipart/form-data">

    <div class="form-group">
        <label>Tên bài viết</label>
        <input type="text" name="tenbaiviet" required>
    </div>

    <div class="form-group">
        <label>Hình ảnh</label>
        <input type="file" name="hinhanh" required>
    </div>

    <div class="form-group">
        <label>Tóm tắt</label>
        <textarea name="tomtat"></textarea>
    </div>

    <div class="form-group">
        <label>Nội dung</label>
        <textarea name="noidung"></textarea>
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
            <option value="1">Kích hoạt</option>
            <option value="0">Ẩn</option>
        </select>
    </div>

    <input 
        type="submit" 
        name="thembaiviet" 
        class="btn-submit" 
        value="Thêm bài viết"
    >

</form>
</div>