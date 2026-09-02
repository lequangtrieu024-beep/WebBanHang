<p>Quản lý thông tin website</p>

<?php
$sql_lh = "SELECT * FROM tbl_lienhe WHERE id=1";
$query_lh = mysqli_query($mysqli, $sql_lh);
$row = mysqli_fetch_array($query_lh);

if(!$row){
    $row = ['thongtinlienhe' => ''];
}
?>

<form method="POST" action="modules/thongtinweb/xuly.php">
<table border="1" width="70%" style="border-collapse: collapse;">

<tr>
   <td>Thông tin liên hệ</td>
   <td>
      <textarea rows="10" name="thongtinlienhe"><?php echo $row['thongtinlienhe']; ?></textarea>
   </td>
</tr>

<tr align="center">
   <td colspan="2">
      <input type="submit" name="lienhe" value="Cập nhật">
   </td>
</tr>

</table>
</form>