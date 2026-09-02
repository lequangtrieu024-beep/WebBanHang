<style type="text/css">
/* ===== Trang thanh toán ===== */
.container {
    max-width: 1100px;
    margin: 0 auto;
    font-family: "Segoe UI", Arial, sans-serif;
    color: #333;
}

/* Breadcrumb các bước (đồng bộ với giỏ hàng) */
.arrow-steps {
    display: flex;
    justify-content: center;
    margin: 20px 0 30px;
}

.arrow-steps .step {
    position: relative;
    flex: 1;
    max-width: 220px;
    text-align: center;
    padding: 12px 20px;
    background: #e9ecef;
    color: #666;
    font-weight: 600;
    margin-right: 2px;
    clip-path: polygon(0 0, 90% 0, 100% 50%, 90% 100%, 0 100%, 10% 50%);
}

.arrow-steps .step:first-child {
    clip-path: polygon(0 0, 90% 0, 100% 50%, 90% 100%, 0 100%);
}

.arrow-steps .step span a {
    color: inherit;
    text-decoration: none;
}

.arrow-steps .step.done {
    background: #cfead9;
    color: #1a7f4b;
}

.arrow-steps .step.current {
    background: #ff6b35;
    color: #fff;
}

/* Khối thông tin + thanh toán */
.checkout-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
    margin-bottom: 30px;
}

.left-box, .right-box {
    flex: 1 1 350px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    padding: 25px 30px;
}

.left-box h4, .right-box h4 {
    font-size: 17px;
    color: #2b2d42;
    margin: 0 0 18px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f1f1;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    padding: 8px 0;
    font-size: 14px;
    border-bottom: 1px dashed #eee;
}

.info-list li:last-child {
    border-bottom: none;
}

.info-list li b {
    color: #2b2d42;
}

/* radio thanh toán */
.form-check {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border: 1px solid #eee;
    border-radius: 8px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: 0.2s;
}

.form-check:hover {
    border-color: #ff6b35;
    background: #fff8f5;
}

.form-check-input {
    width: 17px;
    height: 17px;
    accent-color: #ff6b35;
    cursor: pointer;
}

.form-check-label {
    font-size: 14px;
    cursor: pointer;
    margin: 0;
}

.total-box {
    margin-top: 20px;
    padding-top: 15px;
    border-top: 2px solid #f1f1f1;
    text-align: right;
    font-size: 17px;
    font-weight: 700;
    color: #e63946;
}

.btn-primary {
    width: 100%;
    margin-top: 18px;
    padding: 13px;
    background: #ff6b35;
    color: #fff;
    border: none;
    border-radius: 25px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-primary:hover {
    background: #e55a2b;
}

/* Bảng giỏ hàng */
.cart_heading {
    text-align: center;
    font-size: 20px;
    color: #2b2d42;
    margin: 30px 0 20px;
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border-radius: 10px;
    overflow: hidden;
}

.cart-table th {
    background: #2b2d42;
    color: #fff;
    padding: 12px 10px;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.cart-table td {
    padding: 12px 10px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
    vertical-align: middle;
}

.cart-table tr:hover td {
    background: #fafafa;
}

.cart-table img {
    border-radius: 6px;
    object-fit: cover;
}

.qty {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ddd;
    border-radius: 20px;
    overflow: hidden;
}

.qty-btn {
    display: inline-block;
    width: 28px;
    height: 28px;
    line-height: 28px;
    text-align: center;
    background: #f1f1f1;
    color: #333;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
}

.qty-btn:hover {
    background: #ff6b35;
    color: #fff;
}

.qty-number {
    display: inline-block;
    min-width: 30px;
    text-align: center;
    font-weight: 600;
}

.cart-empty {
    text-align: center;
    padding: 30px 0;
    color: #888;
}
</style>

<p class="checkout_heading" style="text-align:center;font-size:22px;color:#2b2d42;">Hình thức thanh toán</p>


<div class="container">

    <!-- Responsive Arrow Progress Bar -->
    <div class="arrow-steps clearfix">
        <div class="step done"> <span><a href="index.php?quanly=giohang">Giỏ hàng</a></span> </div>
      <div class="step done"><span><a href="index.php?quanly=vanchuyen">Vận chuyển</a></span> </div>
      <div class="step current"><span><a href="index.php?quanly=thanhtoan1">Thanh toán</a></span></div>
        
    </div>
 <form action="pages/main/xulythanhtoan.php" method="POST">   <!-- end Responsive Arrow Progress Bar -->

<?php
if(isset($_SESSION['id_khachhang'])){
    $id_dangky = $_SESSION['id_khachhang'];
}else{
    header("Location:index.php?quanly=dangky");
    exit();
}

$sql_get_vanchuyen = mysqli_query($mysqli,"SELECT * FROM tbl_shipping WHERE id_dangky='$id_dangky' LIMIT 1");

$count = mysqli_num_rows($sql_get_vanchuyen);

if($count > 0){
    $row = mysqli_fetch_array($sql_get_vanchuyen);
    $name    = $row['name'];
    $phone   = $row['phone'];
    $address = $row['address'];
    $note    = $row['note'];
}else{
    $name = $phone = $address = $note = '';
}
?>

<?php
$tongtien = 0;

if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $cart_item){
        $tongtien += $cart_item['soluong'] * $cart_item['giasp'];
    }
}
?>

  <div class="checkout-wrapper">

    <div class="left-box">
        <h4>Thông tin vận chuyển và giỏ hàng</h4>

        <ul class="info-list">
            <li>Họ và tên: <b><?php echo $name; ?></b></li>
            <li>Số điện thoại: <b><?php echo $phone; ?></b></li>
            <li>Địa chỉ: <b><?php echo $address; ?></b></li>
            <li>Ghi chú: <b><?php echo $note; ?></b></li>
        </ul>
  
    </div>

    <div class="right-box">
        <h4>Phương thức thanh toán</h4>
        <div class="form-check">
    <input class="form-check-input" type="radio" 
           name="payment" id="exampleRadios1" 
           value="tiền mặt" checked>
    <label class="form-check-label" for="exampleRadios1">
       Thanh toán tiền mặt
    </label>
</div>

<div class="form-check">
    <input class="form-check-input" type="radio" 
           name="payment" id="exampleRadios2" 
           value="chuyển khoản">
    <label class="form-check-label" for="exampleRadios2">
        Thanh toán chuyển khoản 
    </label>
</div>



     <div class="total-box">
            Tổng Tiền Cần Thanh Toán: <?php echo number_format ($tongtien,0,',','.').'vnđ' ?>
     </div>

     <button type="submit" name="thanhtoanngay" class="btn-primary"> Thanh toán </button>
</div>
</div>
</form> 


      <h2 class="cart_heading"> Giỏ hàng của bạn </h2>
        <table class="cart-table">
  <tr>
    <th>Id</th>
    <th>Mã sản phẩm </th>
    <th>Tên sản phẩm</th>
    <th>Hình ảnh </th>
    <th>Số lượng </th>
    <th>Giá sản phẩm</th>
    <th>Thành tiền </th>
   

  </tr>
  <?php
  if(isset($_SESSION['cart'])){
    $i = 0; 
    $tongtien = 0;
        foreach($_SESSION['cart'] as $cart_item){
             $thanhtien = $cart_item['soluong']*$cart_item['giasp'];
             $tongtien = $tongtien+$thanhtien;
            $i++;
  ?>
  <tr align = "center">
   <td><?php echo $i; ?></td>
   <td><?php echo $cart_item['masp']; ?></td>
   <td><?php echo $cart_item['tensanpham']; ?></td>
   <td><img src ="admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh']; ?>" width = "80px"></td>
   <td>
  <div class="qty">
    <a class="qty-btn" href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>">−</a>

    <span class="qty-number"><?php echo $cart_item['soluong']; ?></span>

    <a class="qty-btn" href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>">+</a>
  </div>
</td>


   <td><?php echo number_format ($cart_item['giasp'],0,',','.').'vnđ'; ?></td>
   <td><?php echo number_format ($thanhtien,0,',','.').'vnđ'  ?></td>
  
  </tr>
  <?php
        }
?>


<?php

    }else{     
  ?>
    <tr align = "center">
           <td colspan="8"><p class="cart-empty">Hiện tại giỏ hàng trống</p></td>
    </tr> 
   <?php
  }
  ?>
</table>
</div>