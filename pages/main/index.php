<?php

if(isset($_GET['trang'])){
  $page = $_GET['trang'];
}else{
  $page = 1;
}
if($page == '' || $page == 1){
  $begin = 0;
}else{
  $begin = ($page*5)-5;
}

$sql_pro = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc ORDER BY tbl_sanpham.id_sanpham DESC LIMIT $begin,5";
  $query_pro = mysqli_query($mysqli,$sql_pro);
?>

<style type="text/css">
/* ===== Danh sách sản phẩm ===== */
.product_section {
    max-width: 1100px;
    margin: 0 auto;
    font-family: "Segoe UI", Arial, sans-serif;
}

.product_section h3 {
    text-align: center;
    font-size: 22px;
    color: #2b2d42;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 10px;
}

.product_section h3::after {
    content: "";
    display: block;
    width: 60px;
    height: 3px;
    background: #ff6b35;
    margin: 8px auto 0;
    border-radius: 2px;
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
}

.product_list li p:nth-of-type(3) {
    display: inline-block;
    background: #f1f1f1;
    color: #666;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 10px;
    margin: 0 12px 10px;
}

/* ===== Phân trang ===== */
.page_info {
    text-align: center;
    color: #888;
    font-size: 14px;
    margin: 20px 0 10px;
}

ul.list_trang{
    padding: 0;
    margin: 0 0 30px;
    list-style: none;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 8px;
}

ul.list_trang li {
    background: #f1f1f1;
    border-radius: 6px;
    transition: 0.2s;
}

ul.list_trang li a {
    display: block;
    padding: 8px 15px;
    color: #333;
    text-align: center;
    text-decoration: none;
    font-weight: 600;
    border-radius: 6px;
}

ul.list_trang li:hover {
    background: #ff6b35;
}

ul.list_trang li:hover a {
    color: #fff;
}

ul.list_trang li.active {
    background: #2b2d42;
}

ul.list_trang li.active a {
    color: #fff;
}
</style>

<div class="product_section">

<h3>Sản phẩm mới nhất</h3>
              <ul class="product_list">
                <?php
                 while($row = mysqli_fetch_array($query_pro)){
                  ?>
                  <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                <img src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>">
                <p>Tên sản phẩm : <?php echo $row['tensanpham']; ?></p>
                <p>Giá : <?php echo number_format($row['giasp'],0,',','.').' vnđ'; ?></p>
                <p><?php echo $row['tendanhmuc']; ?></p>
            </a>
        </li>
                   <?php
                 }
                 ?>
              </ul>

            <?php
                $sql_trang =mysqli_query($mysqli,"SELECT * FROM tbl_sanpham");
                $row_count = mysqli_num_rows($sql_trang);
                 $trang = ceil($row_count/5);
            ?>
            <p class="page_info">Trang : <?php  echo $page ?> / <?php echo $trang ?> </p>

            <ul class="list_trang">
              <?php
                  for($i=1;$i<=$trang;$i++){
              ?>
              <li class="<?php echo ($i==$page) ? 'active' : ''; ?>">
                <a href="index.php?trang=<?php echo $i ?>"><?php echo $i ?></a>
              </li>
            <?php
                  }
            ?>
            </ul>

</div>