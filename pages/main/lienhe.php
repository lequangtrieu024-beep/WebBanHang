<p>Liên hệ</p>
<?php
$sql_lh = "SELECT * FROM tbl_lienhe WHERE id=1";
$query_lh = mysqli_query($mysqli, $sql_lh);
$row = mysqli_fetch_array($query_lh);
?>

<p><?php echo $row['thongtinlienhe'] ?? 'Chưa có dữ liệu'; ?></p>