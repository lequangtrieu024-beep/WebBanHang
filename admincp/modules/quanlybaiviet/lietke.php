<?php
$sql_lietke_bv = "SELECT * FROM tbl_baiviet,tbl_danhmucbaiviet WHERE tbl_baiviet.id_danhmuc = tbl_danhmucbaiviet.id_baiviet 
ORDER BY tbl_baiviet.id ASC";

$query_lietke_bv = mysqli_query($mysqli, $sql_lietke_bv);
?>

<p class="title">📰 Liệt kê bài viết</p>

<div class="table-container">
<table class="custom-table">

    <tr>
        <th>#</th>
        <th>Tên bài viết</th>
        <th>Hình ảnh</th>
        <th>Danh mục</th>
        <th>Tóm tắt</th>
        <th>Trạng thái</th>
        <th>Quản lý</th>
    </tr>

    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_bv)) {
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>

        <td class="name-col">
            <?php echo $row['tenbaiviet'] ?>
        </td>

        <td>
            <img 
                src="modules/quanlybaiviet/uploads/<?php echo $row['hinhanh']; ?>" 
                class="img-preview"
            >
        </td>

        <td><?php echo $row['tendanhmuc_baiviet'] ?></td>

        <td style="max-width:200px;">
            <?php echo substr($row['tomtat'],0,60).'...' ?>
        </td>

        <td>
            <?php 
            if($row['tinhtrang']==1){
                echo '<span class="status active">✔ Kích hoạt</span>';
            } else {
                echo '<span class="status hide">✖ Ẩn</span>';
            }
            ?>
        </td>

        <td class="action-buttons">
            <a 
                href="modules/quanlybaiviet/xuly.php?idbaiviet=<?php echo $row['id']; ?>" 
                class="btn btn-delete"
                onclick="return confirm('Bạn có chắc muốn xóa bài viết này không?')"
            >
                🗑 Xóa
            </a>

            <a 
                href="?action=quanlybaiviet&query=sua&idbaiviet=<?php echo $row['id']; ?>" 
                class="btn btn-edit"
            >
                ✏️ Sửa
            </a>
        </td>
    </tr>

    <?php } ?>

</table>
</div>