<p class="title">Thêm danh mục sản phẩm</p>

<div class="form-card">
<form method="POST" action="modules/quanlydanhmucsp/xuly.php">

    <div class="form-group">
        <label>Tên danh mục</label>
        <input type="text" name="tendanhmuc" placeholder="Nhập tên danh mục..." required>
    </div>

    <div class="form-group">
        <label>Thứ tự</label>
        <input type="number" name="thutu" placeholder="VD: 1, 2, 3..." required>
    </div>

    <button type="submit" name="themdanhmuc" class="btn-submit">
        ➕ Thêm danh mục
    </button>

</form>
</div>