<?php
$sql_lietke_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
ORDER BY id_sanpham ASC";

$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
?>

<p class="title">Liệt kê sản phẩm</p>

<div class="table-container">
<table class="custom-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Danh mục</th>
            <th>Tóm tắt</th>
            <th>Trạng thái</th>
            <th>Quản lý</th>
        </tr>
    </thead>

    <tbody>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_sp)) {
        $i++;
    ?>
        <tr>
            <td><?php echo $i ?></td>

            <td class="name-col">
                <?php echo $row['tensanpham'] ?>
            </td>

            <td>
                <img 
                    src="modules/quanlysp/uploads/<?php echo $row['hinhanh']; ?>" 
                    class="img-product"
                >
            </td>

            <td class="price">
                <?php echo number_format($row['giasp'],0,',','.').' đ' ?>
            </td>

            <td><?php echo $row['soluong'] ?></td>

            <td>
                <span class="badge">
                    <?php echo $row['tendanhmuc'] ?>
                </span>
            </td>

            <td class="desc">
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

            <td>
                <div class="action-buttons">
                    <a href="modules/quanlysp/xuly.php?idsanpham=<?php echo $row['id_sanpham']; ?>" 
                       class="btn btn-delete">
                       ❌
                    </a>

                    <a href="?action=quanlysp&query=sua&idsanpham=<?php echo $row['id_sanpham']; ?>" 
                       class="btn btn-edit">
                       ✏️
                    </a>
                </div>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>