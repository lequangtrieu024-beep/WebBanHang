<?php

include('admincp/config/config.php');

if(isset($_POST['dangnhap'])){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        echo "<p style='color:red'>Vui lòng nhập đầy đủ</p>";
    }else{

        // lấy user theo email
        $sql = "SELECT * FROM tbl_dangky WHERE email='$email' LIMIT 1";
        $query = mysqli_query($mysqli,$sql);

        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);

            // 🔥 so sánh mật khẩu
            if(password_verify($password, $row['matkhau'])){

                $_SESSION['dangky'] = $row['tenkhachhang'];
                $_SESSION['id_khachhang'] = $row['id_dangky'];

                header("Location:index.php?quanly=giohang");
                exit();

            }else{
                echo "<p style='color:red'>Sai mật khẩu</p>";
            }

        }else{
            echo "<p style='color:red'>Email không tồn tại</p>";
        }
    }
}
?>

<h3>Đăng nhập khách hàng</h3>

<div class="form-wrapper">
<form method="POST">

    <div class="form-group">
        <input type="text" name="email" placeholder="Email" class="form-control">
    </div>

    <div class="form-group">
        <input type="password" name="password" placeholder="Mật khẩu" class="form-control">
    </div>

    <input type="submit" name="dangnhap" value="Đăng nhập" class="btn-submit">

</form>

<p>
    Chưa có tài khoản? 
    <a href="index.php?quanly=dangky">Đăng ký</a>
</p>
</div>