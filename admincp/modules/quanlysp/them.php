<p class="title">➕ Thêm sản phẩm</p>

<div class="table-container small">

<form method="POST" action="modules/quanlysp/xuly.php" enctype="multipart/form-data">

    <div class="form-group">
        <label>Tên sản phẩm</label>
        <input type="text" name="tensanpham" placeholder="Nhập tên sản phẩm..." required>
    </div>

    <div class="form-group">
        <label>Mã sản phẩm</label>
        <input type="text" name="masp" placeholder="VD: SP001..." required>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Giá sản phẩm</label>
            <input type="number" name="giasp" placeholder="VD: 100000" required>
        </div>

        <div class="form-group">
            <label>Số lượng</label>
            <input type="number" name="soluong" placeholder="VD: 10" required>
        </div>
    </div>

    <div class="form-group">
        <label>Hình ảnh</label>
        <input type="file" name="hinhanh" id="uploadImg">

        <div class="preview-box">
            <img id="previewImg" src="#" alt="Preview ảnh">
        </div>
    </div>

    <div class="form-group">
        <label>Tóm tắt</label>
        <textarea id="tomtat" name="tomtat" placeholder="Mô tả ngắn..."></textarea>
    </div>

    <div class="form-group">
        <label>Nội dung</label>
        <textarea id="noidung" name="noidung" placeholder="Chi tiết sản phẩm..."></textarea>
    </div>

    <div class="form-group">
        <label>Danh mục sản phẩm</label>
        <select name="danhmuc">
            <?php
            $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
            $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
            while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
            ?>
            <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>">
                <?php echo $row_danhmuc['tendanhmuc'] ?>
            </option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label>Tình trạng</label>
        <select name="tinhtrang">
            <option value="1">✔ Kích hoạt</option>
            <option value="0">✖ Ẩn</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" name="themsanpham" class="btn-submit" value="🚀 Thêm sản phẩm">
    </div>

</form>
</div>

<script>
document.getElementById("uploadImg").onchange = function(evt){
    const [file] = this.files;
    if(file){
        const preview = document.getElementById("previewImg");
        preview.src = URL.createObjectURL(file);
        preview.style.display = "block";
    }
}
</script>