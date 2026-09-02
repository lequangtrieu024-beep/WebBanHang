

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql_bv = "SELECT * FROM tbl_baiviet 
           WHERE id_danhmuc='$id' 
           ORDER BY id DESC";
$query_bv = mysqli_query($mysqli,$sql_bv);

// get tên danh mục
$sql_cate = "SELECT * FROM tbl_danhmucbaiviet 
             WHERE id_baiviet='$id' 
             LIMIT 1";
$query_cate = mysqli_query($mysqli,$sql_cate);
$row_title = mysqli_fetch_array($query_cate);
?>
<h3>
Danh mục bài viết:
<span style="text-transform: uppercase;">
<?php 
    echo ($row_title) ? $row_title['tendanhmuc_baiviet'] : "Chưa có bài viết";
?>
</span>
</h3>

<ul class="product_list">
<?php
    while($row_bv = mysqli_fetch_array($query_bv)){
?>
    <li>
        <a href="index.php?quanly=baiviet&id=<?php echo $row_bv['id'] ?>">
            <img src="admincp/modules/quanlybaiviet/uploads/<?php echo $row_bv['hinhanh'] ?>">
            <p class="title_product">Tên bài viết: <?php echo $row_bv['tenbaiviet'] ?></p>
             <p class="title_product"><?php echo $row_bv['tomtat'] ?></p>
        </a>
    </li>
<?php
    }
?>
</ul>