<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT tbl_sanpham.*, tbl_danhmuc.tendanhmuc
        FROM tbl_sanpham 
        JOIN tbl_danhmuc 
        ON tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
        WHERE tbl_sanpham.id_danhmuc = $id
        ORDER BY tbl_sanpham.id_sanpham DESC";

$query = mysqli_query($mysqli, $sql);
?>

<style type="text/css">
/* ===== Danh mục sản phẩm ===== */
.category_section {
    max-width: 1100px;
    margin: 0 auto;
    font-family: "Segoe UI", Arial, sans-serif;
}

.category_section h3 {
    text-align: center;
    font-size: 22px;
    color: #2b2d42;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 10px;
}

.category_section h3::after {
    content: "";
    display: block;
    width: 60px;
    height: 3px;
    background: #ff6b35;
    margin: 8px auto 0;
    border-radius: 2px;
}

.category_empty {
    text-align: center;
    color: #888;
    padding: 30px 0;
}

.product_list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 0;
    margin: 0;
    list-style: none;
    justify-content: center;
}

.product_list li {
    width: 190px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
}

.product_list li:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
}

.product_list li a {
    display: block;
    text-decoration: none;
    color: #333;
}

.product_list li img {
    width: 100%;
    height: 190px;
    object-fit: cover;
    display: block;
}

.product_list li p {
    padding: 4px 12px;
    margin: 4px 0;
    font-size: 13px;
    line-height: 1.4;
}

.product_list li p:nth-of-type(1) {
    font-weight: 600;
    color: #2b2d42;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.product_list li p:nth-of-type(2) {
    color: #e63946;
    font-weight: 700;
    padding-bottom: 12px;
}
</style>

<div class="category_section">

<?php if (mysqli_num_rows($query) > 0) { 
    $row_title = mysqli_fetch_array($query);
?>
    <h3>Danh mục sản phẩm: <?php echo $row_title['tendanhmuc']; ?></h3>

    <ul class="product_list">
        <?php
        // hiển thị sản phẩm đầu tiên
        ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row_title['id_sanpham'] ?>">
                <img src="admincp/modules/quanlysp/uploads/<?php echo $row_title['hinhanh']; ?>">
                <p>Tên sản phẩm : <?php echo $row_title['tensanpham']; ?></p>
                <p>Giá : <?php echo number_format($row_title['giasp'],0,',','.').' vnđ'; ?></p>
            </a>
        </li>

        <?php
        // hiển thị các sản phẩm còn lại
        while ($row = mysqli_fetch_array($query)) {
        ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                <img src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>">
                <p>Tên sản phẩm : <?php echo $row['tensanpham']; ?></p>
                <p>Giá : <?php echo number_format($row['giasp'],0,',','.').' vnđ'; ?></p>
            </a>
        </li>
        <?php } ?>
    </ul>

<?php } else { ?>
    <h3>Danh mục sản phẩm</h3>
    <p class="category_empty">Danh mục này chưa có sản phẩm.</p>
<?php } ?>

</div>