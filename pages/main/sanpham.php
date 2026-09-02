<p> Chi tiết sản phẩm </p>
<?php
$sql_chitiet = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
AND tbl_sanpham.id_sanpham = '$_GET[id]'  LIMIT 1";
  $query_chitiet = mysqli_query($mysqli,$sql_chitiet);
 while($row_chitiet = mysqli_fetch_array($query_chitiet)){
?>
<script>
function openTab(tabName) {

    var i;
    var content = document.getElementsByClassName("tab_content");
    var tabs = document.getElementsByClassName("tab");

    for (i = 0; i < content.length; i++) {
        content[i].classList.remove("active");
    }

    for (i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove("active");
    }

    document.getElementById(tabName).classList.add("active");
    event.currentTarget.classList.add("active");
}
</script>
<div class="wrapper_chitiet">
   <div class="hinhanh_sanpham">
     <img width = "80%" src="admincp/modules/quanlysp/uploads/<?php echo $row_chitiet['hinhanh'] ?>">
   </div>
 <form method = "POST" action = "pages/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham'] ?>">
   <div class="chitiet_sanpham">
    <h3> Tên sản phẩm : <?php echo $row_chitiet['tensanpham'] ?> </h3>
    <p> Mã sp : <?php echo $row_chitiet['masp'] ?> </p>
    <p>Giá sp : <?php echo number_format( $row_chitiet['giasp'],0,',','.').'vnđ' ?> </p>
    <p>
    Số lượng sp :
    <?php
    if ($row_chitiet['soluong'] <= 0) {
        echo '<span style="color:red; font-weight:bold;">Hết hàng</span>';
    } else {
        echo $row_chitiet['soluong'];
    }
    ?>
</p>

<p>
    Danh mục sp : <?php echo $row_chitiet['tendanhmuc'] ?>
</p>

<?php
if ($row_chitiet['soluong'] > 0) {
?>
    <p>
        <input 
            class="themgiohang" 
            name="themgiohang" 
            type="submit" 
            value="Thêm giỏ hàng">
    </p>
<?php
} else {
?>
    <p>
        <button 
            type="button" 
            disabled
            style="
                background-color: #999;
                color: white;
                border: none;
                padding: 12px 20px;
                cursor: not-allowed;
            ">
            Hết hàng
        </button>
    </p>
<?php
}
?>
   </div>
  <div class="clear">
   <div class="chitiet_tabs">

    <ul class="tabs">
        <li class="tab active" onclick="openTab('tomtat')">Tóm tắt sản phẩm</li>
        <li class="tab" onclick="openTab('noidung')">Nội dung</li>
        
    </ul>

    <div id="tomtat" class="tab_content active">
        <?php echo $row_chitiet['tomtat']; ?>
    </div>

    <div id="noidung" class="tab_content">
        <?php echo $row_chitiet['noidung']; ?>
    </div>

    
</div>
</div>
 </form>
</div>  
<?php
 }
?>