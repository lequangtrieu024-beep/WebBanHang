<style type="text/css">
/* ===== Lịch sử đơn hàng ===== */
.order_section {
    max-width: 1100px;
    margin: 0 auto;
    font-family: "Segoe UI", Arial, sans-serif;
}

.order_section h3 {
    text-align: center;
    font-size: 22px;
    color: #2b2d42;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 10px;
}

.order_section h3::after {
    content: "";
    display: block;
    width: 60px;
    height: 3px;
    background: #ff6b35;
    margin: 8px auto 0;
    border-radius: 2px;
}

.order_table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border-radius: 10px;
    overflow: hidden;
}

.order_table th {
    background: #2b2d42;
    color: #fff;
    padding: 12px 10px;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-align: center;
}

.order_table td {
    padding: 12px 10px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
    text-align: center;
    vertical-align: middle;
}

.order_table tr:hover td {
    background: #fafafa;
}

/* trạng thái đơn hàng */
.status-new {
    color: #3a86ff;
    font-weight: 600;
    background: #eaf2ff;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 13px;
}

.status-confirm a {
    color: #2a9d8f;
    font-weight: 600;
    background: #e6f7f5;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 13px;
    text-decoration: none;
}

.status-confirm a:hover {
    background: #2a9d8f;
    color: #fff;
}

.status-done {
    color: #666;
    font-weight: 600;
    background: #f1f1f1;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 13px;
}

.order_table td a.link-view {
    color: #ff6b35;
    font-weight: 600;
    text-decoration: none;
}

.order_table td a.link-view:hover {
    text-decoration: underline;
}
</style>

<div class="order_section">

<h3>Lịch sử đơn hàng</h3>

<?php
   $id_khachhang = $_SESSION['id_khachhang'];  
   $sql_lietke_dh = "SELECT * FROM tbl_cart,tbl_dangky WHERE tbl_cart.id_khachhang=tbl_dangky.id_dangky AND tbl_cart.id_khachhang='$id_khachhang' ORDER BY tbl_cart.id_cart ASC";
   $query_lietke_dh =  mysqli_query($mysqli, $sql_lietke_dh);
?>
<?php

if (isset($_GET['update_tinhtrang']) && $_GET['update_tinhtrang'] != '') {

    $update_tinhtrang = $_GET['update_tinhtrang'];

    $sql_update_tinhtrangdonhang = mysqli_query(
        $mysqli,
        "UPDATE tbl_cart SET cart_status=3 WHERE code_cart='$update_tinhtrang'"
    );

    
}
?>

<table class="order_table">
  <tr>
     <th>ID</th>
    <th>Mã đơn hàng</th>
    <th>Tên khách hàng</th>
    <th>Địa chỉ</th>
    <th>Email</th>
    <th>Số điện thoại</th>
    <th>Tình trạng</th>
    <th>Ngày đặt</th>
    <th>Quản Lý</th>
    <th>Hình thức thanh toán</th>
  </tr>

         <?php
                  $i = 0;
                  while ($row = mysqli_fetch_array($query_lietke_dh))
                    {    
                        $i++; 
         ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['code_cart'] ?></td>
    <td><?php echo $row['tenkhachhang'] ?></td>
    <td><?php echo $row['diachi'] ?></td>
    <td><?php echo $row['email'] ?></td>
    <td><?php echo $row['dienthoai'] ?></td>
       <td>
        <?php
              if($row['cart_status']==1){
                echo '<span class="status-new">Đơn hàng mới</span>' ;
              }else if($row['cart_status']==2){echo '<span class="status-confirm"><a onclick="return confirm(\'Xác nhận đã nhận\')" href="'.$_SERVER['REQUEST_URI'].'&update_tinhtrang='.$row['code_cart'].'">Đã nhận hàng</a></span>';
                 }else{
                echo '<span class="status-done">Đã nhận</span>' ;
              }
             
        ?>
    </td>
    <td><?php echo $row['cart_date'] ?></td>
    <td>
        <a class="link-view" href="index.php?quanly=xemdonhang&code=<?php echo $row['code_cart']; ?>">Xem đơn hàng</a> 
    </td>
    <td><?php echo $row['cart_payment'] ?></td>
  </tr>

  <?php
                    }
   ?>                 
</table>

</div>