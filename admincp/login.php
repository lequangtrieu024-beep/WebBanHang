<?php
session_start();
include('config/config.php');

if(isset($_POST['dangnhap'])){
    $taikhoan = $_POST['username'];
    $matkhau = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin 
            WHERE username='".$taikhoan."' 
            AND password='".$matkhau."' 
            LIMIT 1";

    $row = mysqli_query($mysqli,$sql);
    $count = mysqli_num_rows($row);

    if($count>0){
        $_SESSION['dangnhap'] = $taikhoan;
        header('Location:index.php');
    }else{
        echo '<script>
            alert("Tài khoản hoặc mật khẩu sai || Vui lòng nhập lại");
            window.location="login.php";
        </script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đăng nhập Admin</title>

<style>
body{
    background: #f2f2f2;
    font-family: Arial;
}

/* box login */
.wrapper-login{
    width: 300px;
    margin: 100px auto;
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

/* title */
.wrapper-login h3{
    text-align: center;
    margin-bottom: 20px;
}

/* input */
.form-group{
    margin-bottom: 15px;
}

.form-group label{
    display: block;
    margin-bottom: 5px;
}

.form-group input{
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* button */
.btn-login{
    width: 100%;
    padding: 10px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-login:hover{
    background: #218838;
}
</style>

</head>

<body>

<div class="wrapper-login">
    <form action="" method="POST" autocomplete="off">
        <h3>Đăng Nhập Admin</h3>

        <div class="form-group">
            <label>Tài Khoản</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Mật Khẩu</label>
            <input type="password" name="password" required>
        </div>

        <input type="submit" name="dangnhap" value="Đăng Nhập" class="btn-login">
    </form>
</div>

</body>
</html>