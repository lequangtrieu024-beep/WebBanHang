<style type="text/css">
/* ===== Trang vận chuyển ===== */
.container {
    max-width: 1000px;
    margin: 0 auto;
    font-family: "Segoe UI", Arial, sans-serif;
    color: #333;
}

/* Breadcrumb các bước (đồng bộ site) */
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

.container h3 {
    text-align: center;
    font-size: 20px;
    color: #2b2d42;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.container h3::after {
    content: "";
    display: block;
    width: 50px;
    height: 3px;
    background: #ff6b35;
    margin: 8px auto 0;
    border-radius: 2px;
}

/* Form vận chuyển */
.form-wrapper {
    max-width: 480px;
    margin: 0 auto 35px;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #555;
    margin-bottom: 6px;
}

.form-control {
    width: 100%;
    padding: 11px 14px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    box-sizing: border-box;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: #ff6b35;
    box-shadow: 0 0 0 3px rgba(255,107,53,0.15);
}

.form-control::placeholder {
    color: #aaa;
}

.btn-primary {
    width: 100%;
    margin-top: 8px;
    padding: 12px;
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

.cart-summary-row td {
    background: #f8f9fa;
    padding: 15px;
}

.cart-total-text {
    font-size: 18px;
    font-weight: 700;
    color: #2b2d42;
    text-align: center;
    margin: 0 0 12px;
}

.cart-checkout-link {
    text-align: center;
}

.cart-checkout-link a {
    display: inline-block;
    background: #ff6b35;
    color: #fff;
    padding: 10px 28px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.2s;
}

.cart-checkout-link a:hover {
    background: #e55a2b;
}

.cart-empty {
    text-align: center;
    padding: 30px 0;
    color: #888;
}
</style>

<p style="text-align:center;font-size:22px;color:#2b2d42;">Thông tin vận chuyển</p>

<div class="container">

    <!-- Responsive Arrow Progress Bar -->
    <div class="arrow-steps clearfix">

       <div class="step done"> <span><a href="index.php?quanly=giohang">Giỏ hàng</a></span> </div>
      <div class="step current"><span><a href="index.php?quanly=vanchuyen">Vận chuyển</a></span> </div>
      <div class="step"><span><a href="index.php?quanly=thanhtoan1">Thanh toán</a></span></div>
        
    </div>

  <!-- Tiêu đề lớn -->
    <h3>Thông tin vận chuyển</h3>

    <?php
      $id_dangky_post = isset($_SESSION['id_khachhang']) ? mysqli_real_escape_string($mysqli, $_SESSION['id_khachhang']) : '';

          if(isset($_POST['themvanchuyen'])){
            $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
            $phone = mysqli_real_escape_string($mysqli, trim($_POST['phone']));
            $address = mysqli_real_escape_string($mysqli, trim($_POST['address']));
            $note = mysqli_real_escape_string($mysqli, trim($_POST['note']));
            $id_dangky = $id_dangky_post;
            $sql_them_vanchuyen = mysqli_query($mysqli,"INSERT INTO tbl_shipping (name,phone,address,note,id_dangky) VALUES('$name','$phone','$address','$note'
            ,'$id_dangky')");
            
            if($sql_them_vanchuyen){
                echo '<script>alert("Thêm vận chuyển thành công")</script>';
            }
          }elseif(isset($_POST['capnhatvanchuyen'])){
              $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
            $phone = mysqli_real_escape_string($mysqli, trim($_POST['phone']));
            $address = mysqli_real_escape_string($mysqli, trim($_POST['address']));
            $note = mysqli_real_escape_string($mysqli, trim($_POST['note']));
            $id_dangky = $id_dangky_post;
            $sql_vanchuyen = mysqli_query($mysqli,"UPDATE tbl_shipping SET name='$name',phone='$phone',address='$address',note='$note' WHERE id_dangky='$id_dangky'");
            
            if($sql_vanchuyen){
                echo '<script>alert("Cập nhật vận chuyển thành công")</script>';
            } 
          }
    ?>

    <div class="form-wrapper">

    <?php
    if(isset($_SESSION['id_khachhang'])){
    $id_dangky = $_SESSION['id_khachhang'];
     }else{
    header("Location:index.php?quanly=dangky");
    exit();
}
    $sql_get_vanchuyen = mysqli_query($mysqli,"SELECT * FROM tbl_shipping WHERE id_dangky='$id_dangky'  LIMIT 1");
    $count = mysqli_num_rows($sql_get_vanchuyen);

if($count > 0){

    $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);

    $name = $row_get_vanchuyen['name'];
    $phone = $row_get_vanchuyen['phone'];
    $address = $row_get_vanchuyen['address'];
    $note = $row_get_vanchuyen['note'];

}else{

    $name = '';
    $phone = '';
    $address = '';
    $note = '';

}
?>
      
        <form action="" autocomplete="off" method="POST">
            
            <div class="form-group">
                <label>Họ và tên:</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name) ?>" placeholder="....">
            </div>

            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($phone) ?>" placeholder="....">
            </div>

             <div class="form-group">
                <label>Address:</label>
                <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($address) ?>" placeholder="....">
            </div>

           <div class="form-group">
                <label>Ghi chú:</label>
                <input type="text" name="note" class="form-control" value="<?php echo htmlspecialchars($note) ?>" placeholder="....">
            </div>

           <?php
             if($name=='' && $phone==''){
              ?>
             <button type="submit" name="themvanchuyen" class="btn-primary"> Thêm vận chuyển</button>
              <?php
              }elseif($name!='' && $phone!=''){
              ?>
    <button type="submit" name="capnhatvanchuyen" class="btn-primary"> Cập nhật vận chuyển</button>
             <?php
            }
               ?>

        </form>


    </div>

</div>
<!------------------Giỏ hàng------------------------->
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
<tr class="cart-summary-row">
           <td colspan="8">
            <p class="cart-total-text">Tổng Tiền : <?php echo number_format ($tongtien,0,',','.').'vnđ' ?></p>
            <div class="cart-checkout-link">
            <?php
                   if(isset($_SESSION['dangky'])){
            ?>
                    <a href="index.php?quanly=thanhtoan1">Thanh toán</a>
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
    <tr align = "center">
           <td colspan="8"><p class="cart-empty">Hiện tại giỏ hàng trống</p></td>
    </tr> 
   <?php
  }
  ?>
</table>