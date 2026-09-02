<p class="title">📰 Thêm danh mục bài viết</p>

<div class="table-container small">

<form method="POST" action="modules/quanlydanhmucbaiviet/xuly.php">

    <div class="form-group">
        <label>Tên danh mục</label>
        <input 
            type="text" 
            name="tendanhmucbaiviet" 
            placeholder="Nhập tên danh mục bài viết..." 
            required
        >
    </div>

    <div class="form-group">
        <label>Thứ tự hiển thị</label>
        <input 
            type="number" 
            name="thutu" 
            placeholder="VD: 1, 2, 3..." 
            min="1"
            required
        >
    </div>

    <div class="form-group">
        <input 
            type="submit" 
            name="themdanhmucbaiviet" 
            class="btn-submit" 
            value="➕ Thêm danh mục"
        >
    </div>

</form>

</div>