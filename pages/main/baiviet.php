<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql_bv = "SELECT * FROM tbl_baiviet 
           WHERE id='$id' 
           LIMIT 1";
$query_bv = mysqli_query($mysqli,$sql_bv);
$query_bv_all = mysqli_query($mysqli,$sql_bv);

$row_bv_title = mysqli_fetch_array($query_bv);
?>

<style type="text/css">
/* ===== Bài viết chi tiết ===== */
.article_section {
    max-width: 800px;
    margin: 0 auto;
    font-family: "Segoe UI", Arial, sans-serif;
    color: #333;
}

.article_heading {
    text-align: center;
    font-size: 15px;
    color: #888;
    font-weight: 400;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.article_heading span {
    display: block;
    font-size: 24px;
    font-weight: 700;
    color: #2b2d42;
    margin-top: 6px;
    letter-spacing: 0.5px;
}

ul.baiviet {
    list-style: none;
    padding: 0;
    margin: 0;
}

ul.baiviet li {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    padding: 25px 30px;
    margin-bottom: 20px;
}

ul.baiviet li h2 {
    font-size: 20px;
    color: #ff6b35;
    margin: 0 0 15px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f1f1;
}

ul.baiviet li img {
    max-width: 100%;
    border-radius: 8px;
    margin-bottom: 15px;
    display: block;
}

.title_product {
    font-size: 16px;
    line-height: 1.8;
    color: #444;
    text-align: justify;
}

.title_product img {
    max-width: 100%;
    height: auto;
    border-radius: 6px;
    margin: 10px 0;
}
</style>

<div class="article_section">

<h3 class="article_heading">
 Bài viết:
<span>
<?php 
    echo ($row_bv_title) ? $row_bv_title['tenbaiviet'] : "Chưa có bài viết";
?>
</span>
</h3>

<ul class="baiviet" >
<?php
    while($row_bv = mysqli_fetch_array($query_bv_all)){
?>
    <li>
       <h2> <?php echo $row_bv['tenbaiviet'] ?></h2>
            <!-- <img src="admincp/modules/quanlybaiviet/uploads/<?php echo $row_bv['hinhanh'] ?>"> -->
            <!-- <p class="title_product"> <?php echo $row_bv['tomtat'] ?></p> -->
             <p class="title_product"><?php echo $row_bv['noidung'] ?></p>
  
    </li>
<?php
    }
?>
</ul>

</div>