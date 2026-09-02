<?php
$sql_lietke_dh = "
    SELECT 
        c.id_cart,
        c.code_cart,
        c.cart_status,
        c.cart_date,
        d.tenkhachhang,
        d.diachi,
        d.email,
        d.dienthoai
    FROM tbl_cart AS c
    INNER JOIN tbl_dangky AS d 
        ON c.id_khachhang = d.id_dangky
    ORDER BY c.id_cart DESC
";

$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>

<p class="title">📦 Liệt kê đơn hàng</p>

<div class="table-container">
<table class="custom-table">

    <tr>
        <th>#</th>
        <th>Mã đơn</th>
        <th>Khách hàng</th>
        <th>Địa chỉ</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Trạng thái</th>
        <th>Ngày đặt</th>
        <th>Quản lý</th>
    </tr>

    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_dh)) {
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>

        <td>
            <strong><?php echo $row['code_cart'] ?></strong>
        </td>

        <td class="name-col">
            <?php echo $row['tenkhachhang'] ?>
        </td>

        <td><?php echo $row['diachi'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['dienthoai'] ?></td>

        <td>
            <?php
            if($row['cart_status']==1){
                echo '<span class="status new">🆕 Mới</span>';
            }elseif($row['cart_status']==2){
                echo '<span class="status ship">🚚 Đang giao</span>';
            }else{
                echo '<span class="status done">✅ Hoàn thành</span>';
            }
            ?>
        </td>

        <td>
            <?php 
                echo date('d/m/Y H:i', strtotime($row['cart_date']));
            ?>
        </td>

        <td class="action-buttons">
            <a 
                href="index.php?action=donhang&query=xemdonhang&code=<?php echo $row['code_cart']; ?>" 
                class="btn btn-view"
            >
                👁 Xem đơn hàng 
            </a>
        </td>
    </tr>

    <?php } ?>

</table>
</div>