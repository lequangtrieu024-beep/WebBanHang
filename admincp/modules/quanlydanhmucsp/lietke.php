<?php
$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY thutu ASC";
$query_lietke_danhmucsp =  mysqli_query($mysqli, $sql_lietke_danhmucsp);
?>

<p class="title">Liệt Kê Danh Mục Sản Phẩm</p>

<div class="table-container">
<table class="custom-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Quản lý</th>
        </tr>
    </thead>

    <tbody>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_danhmucsp)){
        $i++;
    ?>
        <tr>
            <td><?php echo $i ?></td>

            <td class="name-col">
                <?php echo $row['tendanhmuc'] ?>
            </td>

            <td>
                <div class="action-buttons">
                    <a href="javascript:void(0)" 
                       onclick="confirmDelete(<?php echo $row['id_danhmuc']; ?>)" 
                       class="btn btn-delete">
                       ❌ Xóa
                    </a>

                    <a href="?action=quanlydanhmucsanpham&query=sua&iddanhmuc=<?php echo $row['id_danhmuc']; ?>" 
                       class="btn btn-edit">
                       ✏️ Sửa
                    </a>
                </div>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>

<script>
function confirmDelete(id){
    if(confirm("Bạn có chắc muốn xóa danh mục này không?")){
        window.location = "modules/quanlydanhmucsp/xuly.php?iddanhmuc=" + id;
    }
}
</script>