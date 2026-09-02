<?php
$code = mysqli_real_escape_string($mysqli, $_GET['code']);

// LẤY CHI TIẾT ĐƠN HÀNG
$sql_lietke_dh = "
    SELECT 
        cd.code_cart,
        cd.soluongmua,
        sp.tensanpham,
        sp.giasp
    FROM tbl_cart_details AS cd
    INNER JOIN tbl_sanpham AS sp 
        ON cd.id_sanpham = sp.id_sanpham
    WHERE cd.code_cart = '$code'
    ORDER BY cd.id_cart_details ASC
";

$query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh);

// LẤY TRẠNG THÁI ĐƠN
$sql_cart = "SELECT cart_status FROM tbl_cart WHERE code_cart = '$code' LIMIT 1";
$query_cart = mysqli_query($mysqli,$sql_cart);
$row_cart = mysqli_fetch_array($query_cart);
?>

<p class="title">📄 Xem đơn hàng: <?php echo $code; ?></p>

<div class="table-container">
<table class="custom-table">

<tr>
    <th>#</th>
    <th>Tên sản phẩm</th>
    <th>Số lượng</th>
    <th>Đơn giá</th>
    <th>Thành tiền</th>
</tr>

<?php
$i = 0;
$tongtien = 0;

while ($row = mysqli_fetch_array($query_lietke_dh)) {
    $i++;
    $thanhtien = $row['giasp'] * $row['soluongmua'];
    $tongtien += $thanhtien;
?>

<tr>
    <td><?php echo $i ?></td>
    <td class="name-col"><?php echo $row['tensanpham'] ?></td>
    <td><?php echo $row['soluongmua'] ?></td>
    <td><?php echo number_format($row['giasp'],0,',','.').' vnđ' ?></td>
    <td><?php echo number_format($thanhtien,0,',','.').' vnđ' ?></td>
</tr>

<?php } ?>

<tr>
    <td colspan="5" style="text-align:right;">
        <strong>💰 Tổng tiền: <?php echo number_format($tongtien,0,',','.').' vnđ'; ?></strong>
    </td>
</tr>

<tr>
<td colspan="5">

<p><strong>Cập nhật trạng thái đơn hàng:</strong></p>

<form method="POST" action="modules/quanlydonhang/xuly.php">

<input type="hidden" value="<?php echo $code ?>" name="code_cart">

<select name="tinhtrangdonhang" class="form-control">

    <option value="1" <?php if($row_cart['cart_status']==1) echo 'selected'; ?>>
        🆕 Đơn hàng mới
    </option>

    <option value="2" <?php if($row_cart['cart_status']==2) echo 'selected'; ?>>
        🚚 Đang vận chuyển
    </option>

    <option value="3" <?php if($row_cart['cart_status']==3) echo 'selected'; ?>>
        ✅ Hoàn thành
    </option>

</select>

<br>

<input type="submit" name="update_cart" value="Cập nhật" class="btn-submit">

</form>

</td>
</tr>

</table>
</div>