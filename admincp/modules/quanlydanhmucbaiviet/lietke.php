<?php
$sql_lietke_danhmucbv = "SELECT * FROM tbl_danhmucbaiviet ORDER BY thutu ASC";
 $query_lietke_danhmucbv = mysqli_query($mysqli, $sql_lietke_danhmucbv);
?>

<p class="title">📰 Liệt kê danh mục bài viết</p>

<div class="table-container small">
<table class="custom-table">
    <tr>
        <th>#</th>
        <th>Tên danh mục</th>
        <th>Thứ tự</th>
        <th>Quản lý</th>
    </tr>

    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_danhmucbv)) {
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>

        <td class="name-col">
            <?php echo $row['tendanhmuc_baiviet'] ?>
        </td>

        <td><?php echo $row['thutu'] ?></td>

        <td class="action-buttons">

            <a 
                href="modules/quanlydanhmucbaiviet/xuly.php?idbaiviet=<?php echo $row['id_baiviet']; ?>" 
                class="btn btn-delete"
                onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?')"
            >
                🗑 Xóa
            </a>

            <a 
                href="?action=quanlydanhmucbaiviet&query=sua&idbaiviet=<?php echo $row['id_baiviet']; ?>" 
                class="btn btn-edit"
            >
                ✏️ Sửa
            </a>

        </td>
    </tr>
    <?php } ?>
</table>
</div>