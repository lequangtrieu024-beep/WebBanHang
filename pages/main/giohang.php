<style>
/* ===== Giỏ hàng - Style ===== */
.cart-wrapper {
    max-width: 1000px;
    margin: 0 auto;
    font-family: "Segoe UI", Arial, sans-serif;
    color: #333;
}

.cart-user-info {
    text-align: center;
    background: #f4f6f8;
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 15px;
    margin-bottom: 15px;
}

/* Breadcrumb các bước */
.arrow-steps {
    display: flex;
    justify-content: center;
    margin: 20px 0;
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

.arrow-steps .step.current {
    background: #ff6b35;
    color: #fff;
}

/* Bảng sản phẩm */
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
    font-size: 14px;
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

/* Nút tăng giảm số lượng */
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

/* Link xóa */
.link-xoa {
    color: #e63946;
    text-decoration: none;
    font-weight: 600;
}

.link-xoa:hover {
    text-decoration: underline;
}

/* Hàng tổng tiền */
.cart-summary-row td {
    background: #f8f9fa;
    padding: 15px;
}

.cart-summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.cart-total-text {
    font-size: 18px;
    font-weight: 700;
    color: #2b2d42;
}

.cart-clear-all {
    color: #e63946;
    text-decoration: none;
    font-weight: 600;
    border: 1px solid #e63946;
    padding: 6px 14px;
    border-radius: 20px;
    transition: 0.2s;
}

.cart-clear-all:hover {
    background: #e63946;
    color: #fff;
}

.cart-checkout-btn {
    display: block;
    text-align: center;
    margin-top: 15px;
}

.cart-checkout-btn a {
    display: inline-block;
    background: #ff6b35;
    color: #fff;
    padding: 12px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: 0.2s;
}

.cart-checkout-btn a:hover {
    background: #e55a2b;
}

.cart-empty {
    text-align: center;
    padding: 40px 0;
    font-size: 16px;
    color: #888;
}
</style>

<div class="cart-wrapper">

<p class="cart-user-info">
<?php
   if(isset($_SESSION['dangky']))
    {
       echo $_SESSION['dangky'];
        echo ' : ';
       echo $_SESSION['id_khachhang']; 
    }
?>
</p>

<?php
   if(isset($_SESSION['cart']))
    {
       
    }
?>

<div class="container">
    <div class="arrow-steps">
      <div class="step current"> <span><a href="index.php?quanly=giohang">Giỏ hàng</a></span> </div>
      <div class="step"><span><a href="index.php?quanly=vanchuyen">Vận chuyển</a></span> </div>
      <div class="step"><span><a href="index.php?quanly=thanhtoan1">Thanh toán</a></span></div>
    </div>
</div>
<br>

<table class="cart-table">
  <tr>
    <th>Id</th>
    <th>Mã sản phẩm</th>
    <th>Tên sản phẩm</th>
    <th>Hình ảnh</th>
    <th>Số lượng</th>
    <th>Giá sản phẩm</th>
    <th>Thành tiền</th>
    <th>Xóa</th>
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
  <tr align="center">
   <td><?php echo $i; ?></td>
   <td><?php echo $cart_item['masp']; ?></td>
   <td><?php echo $cart_item['tensanpham']; ?></td>
   <td><img src="admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh']; ?>" width="80px" height="80px"></td>
   <td>
      <div class="qty">
        <a class="qty-btn" href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>">−</a>
        <span class="qty-number"><?php echo $cart_item['soluong']; ?></span>
        <a class="qty-btn" href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>">+</a>
      </div>
   </td>
   <td><?php echo number_format ($cart_item['giasp'],0,',','.').'vnđ'; ?></td>
   <td><?php echo number_format ($thanhtien,0,',','.').'vnđ'  ?></td>
   <td><a class="link-xoa" href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>">Xóa</a></td>
  </tr>
  <?php
        }
?>
<tr class="cart-summary-row">
   <td colspan="8">
      <div class="cart-summary">
        <p class="cart-total-text">Tổng Tiền: <?php echo number_format ($tongtien,0,',','.').'vnđ' ?></p>
        <a class="cart-clear-all" href="pages/main/themgiohang.php?xoatatca=1">Xóa Tất Cả</a>
      </div>
      <div class="cart-checkout-btn">
            <?php
                   if(isset($_SESSION['dangky'])){
            ?>
                    <a href="index.php?quanly=vanchuyen">Hình thức vận chuyển</a>
            <?php
                   }else{
             ?>
                    <a href="index.php?quanly=dangky">Đăng Ký Đặt Hàng</a>
             <?php          
                   }
            ?>
      </div>
   </td>
</tr>
<?php
    }else{     
  ?>
    <tr align="center">
       <td colspan="8"><p class="cart-empty">Hiện tại giỏ hàng trống</p></td>
    </tr> 
   <?php
  }
  ?>
</table>

</div>