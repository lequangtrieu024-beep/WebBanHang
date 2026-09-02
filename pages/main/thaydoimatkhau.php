<?php
   if(isset($_POST['doimatkhau'])){
    $taikhoan = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    $password_cu = $_POST['password_cu'];
    $password_moi = $_POST['password_moi'];

    $sql = "SELECT * FROM tbl_dangky WHERE email='".$taikhoan."' LIMIT 1";
    $row = mysqli_query($mysqli,$sql);
    $data = mysqli_fetch_array($row);

    if($data && password_verify($password_cu, $data['matkhau'])){
        $matkhau_moi_hash = password_hash($password_moi, PASSWORD_DEFAULT);
        mysqli_query($mysqli,"UPDATE tbl_dangky SET matkhau='".$matkhau_moi_hash."' WHERE email='".$taikhoan."'");
        $thongbao = '<p class="msg msg-success">Mật khẩu đã thay đổi</p>';
    }else{
        $thongbao = '<p class="msg msg-error">Tài khoản hoặc mật khẩu cũ sai, vui lòng nhập lại</p>';
    }
}
?>

<style type="text/css">
/* ===== Đổi mật khẩu ===== */
.table-login {
    max-width: 420px;
    margin: 40px auto;
    background: #fff;
    border: none !important;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    font-family: "Segoe UI", Arial, sans-serif;
    overflow: hidden;
}

.table-login tr td {
    border: none !important;
    padding: 10px 25px;
}

.table-login h3 {
    text-align: center;
    color: #2b2d42;
    margin: 20px 0 10px;
    position: relative;
    padding-bottom: 12px;
}

.table-login h3::after {
    content: "";
    display: block;
    width: 50px;
    height: 3px;
    background: #ff6b35;
    margin: 8px auto 0;
    border-radius: 2px;
}

.table-login tr:not(:first-child):not(:last-child) td:first-child {
    text-align: left;
    font-size: 14px;
    color: #555;
    font-weight: 600;
    width: 40%;
}

.table-login input[type="text"],
.table-login input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    box-sizing: border-box;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.table-login input[type="text"]:focus,
.table-login input[type="password"]:focus {
    outline: none;
    border-color: #ff6b35;
    box-shadow: 0 0 0 3px rgba(255,107,53,0.15);
}

.table-login input[type="submit"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    background: #ff6b35;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.table-login input[type="submit"]:hover {
    background: #e55a2b;
}

.msg {
    max-width: 420px;
    margin: 20px auto -10px;
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 14px;
    text-align: center;
}

.msg-success {
    background: #e6f7f0;
    color: #1a7f4b;
    border: 1px solid #b7e6cf;
}

.msg-error {
    background: #fdecea;
    color: #c0392b;
    border: 1px solid #f5c6cb;
}
</style>

<?php if(isset($thongbao)) echo $thongbao; ?>

 <form action="" autocomplete="off" method="POST">
    <table class="table-login">
         <tr>
            <td colspan="2"><h3>Đổi mật khẩu</h3></td>
        </tr>
        <tr>
            <td>Tài Khoản</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Mật Khẩu cũ</td>
            <td><input type="password" name="password_cu"></td>
        </tr>
        <tr>
            <td>Mật Khẩu mới</td>
            <td><input type="password" name="password_moi"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="doimatkhau" value="Đổi mật khẩu"></td>
        </tr>
    </table>
  </form>