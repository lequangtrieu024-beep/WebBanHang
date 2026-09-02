<?php
$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
?>  
<?php
 if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    session_unset();
    session_destroy();
}
?>

<style type="text/css">
/* ===== Menu điều hướng ===== */
.menu {
    background: #2b2d42;
    font-family: "Segoe UI", Arial, sans-serif;
}

.list_menu {
    max-width: 1100px;
    margin: 0 auto;
    list-style: none;
    padding: 0;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

.list_menu > li {
    position: relative;
}

.list_menu > li > a {
    display: block;
    padding: 16px 18px;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: background 0.2s, color 0.2s;
}

.list_menu > li > a:hover {
    background: #ff6b35;
    color: #fff;
}

/* Form tìm kiếm nằm trong menu */
.menu form {
    margin: 0 0 0 auto;
    display: flex;
}

.menu form li {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 0;
}

.menu form input[type="text"] {
    padding: 8px 14px;
    border: none;
    border-radius: 20px 0 0 20px;
    font-size: 13px;
    width: 200px;
    outline: none;
}

.menu form input[type="submit"] {
    padding: 8px 16px;
    border: none;
    border-radius: 0 20px 20px 0;
    background: #ff6b35;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.menu form input[type="submit"]:hover {
    background: #e55a2b;
}

.clear {
    clear: both;
}

/* Responsive: menu xuống hàng trên màn hình nhỏ */
@media (max-width: 768px) {
    .list_menu {
        flex-direction: column;
        align-items: stretch;
    }

    .menu form {
        margin: 10px 0;
        padding: 0 15px;
    }

    .menu form input[type="text"] {
        width: 100%;
    }
}
</style>

<div class="menu">
    <ul class="list_menu">
        <li><a href="index.php">Trang chủ</a></li>
        <li><a href="index.php?quanly=giohang">Giỏ hàng</a></li>
        <li><a href="index.php?quanly=tintuc">Tin tức</a></li>
        <li><a href="index.php?quanly=lienhe">Liên hệ</a></li>


<form action="index.php?quanly=timkiem" method="POST">
        <li>
              <input type="text" placeholder="Tìm kiếm sản phẩm...." name="tukhoa">
              <input type="submit" name="timkiem" value="Tìm Kiếm">
        </li>
</form>


        <?php
        if(isset($_SESSION['dangky'])){
            
       ?>
       <li><a href="index.php?dangxuat=1">Đăng Xuất</a></li>
       <li><a href="index.php?quanly=thaydoimatkhau">Đổi mật khẩu </a></li>
       <li><a href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng </a></li>
       <?php
        }else{
        ?>
        <li><a href="index.php?quanly=dangky">Đăng Ký</a></li>
        <?php
        }
        ?>
        


    </ul>
</div>

<div class="clear"></div>