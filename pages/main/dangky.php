<?php

include('admincp/config/config.php');

$err_hovaten = '';
$err_email = '';
$err_dienthoai = '';
$err_matkhau = '';
$err_chung = '';

// giữ lại giá trị đã nhập để không mất khi submit lỗi
$val_hovaten = '';
$val_email = '';
$val_dienthoai = '';
$val_diachi = '';

if(isset($_POST['dangky'])){

    $tenkhachhang = trim($_POST['hovaten']);
    $email = trim($_POST['email']);
    $dienthoai = trim($_POST['dienthoai']);
    $diachi = trim($_POST['diachi']);
    $matkhau_raw = $_POST['matkhau'];

    $val_hovaten = $tenkhachhang;
    $val_email = $email;
    $val_dienthoai = $dienthoai;
    $val_diachi = $diachi;

    $hople = true;

    // ❗ kiểm tra rỗng từng ô
    if(empty($tenkhachhang)){
        $err_hovaten = 'Vui lòng nhập họ và tên';
        $hople = false;
    }

    if(empty($email)){
        $err_email = 'Vui lòng nhập email';
        $hople = false;
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $err_email = 'Email không hợp lệ';
        $hople = false;
    }

    if(!empty($dienthoai) && !preg_match('/^[0-9]{9,11}$/', $dienthoai)){
        $err_dienthoai = 'Số điện thoại không hợp lệ';
        $hople = false;
    }

    if(empty($matkhau_raw)){
        $err_matkhau = 'Vui lòng nhập mật khẩu';
        $hople = false;
    }elseif(strlen($matkhau_raw) < 6){
        $err_matkhau = 'Mật khẩu phải từ 6 ký tự trở lên';
        $hople = false;
    }

    // ❗ kiểm tra email tồn tại (chỉ check khi email hợp lệ)
    if($hople){
        $email_safe = mysqli_real_escape_string($mysqli, $email);
        $check = mysqli_query($mysqli,"SELECT * FROM tbl_dangky WHERE email='$email_safe' LIMIT 1");

        if(mysqli_num_rows($check) > 0){
            $err_email = 'Email đã tồn tại';
            $hople = false;
        }
    }

    if($hople){
        $matkhau = password_hash($matkhau_raw, PASSWORD_DEFAULT);

        $tenkhachhang_safe = mysqli_real_escape_string($mysqli, $tenkhachhang);
        $diachi_safe = mysqli_real_escape_string($mysqli, $diachi);
        $dienthoai_safe = mysqli_real_escape_string($mysqli, $dienthoai);

        $sql = "INSERT INTO tbl_dangky(tenkhachhang,email,diachi,matkhau,dienthoai) 
                VALUES('$tenkhachhang_safe','$email_safe','$diachi_safe','$matkhau','$dienthoai_safe')";

        if(mysqli_query($mysqli,$sql)){
            $_SESSION['dangky'] = $tenkhachhang;
            $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);

            header("Location:index.php?quanly=giohang");
            exit();
        }else{
            $err_chung = 'Đăng ký thất bại, vui lòng thử lại';
        }
    }
}
?>

<style type="text/css">
/* ===== Form đăng ký ===== */
.form-wrapper {
    max-width: 420px;
    margin: 40px auto;
    background: #fff;
    padding: 35px 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    font-family: "Segoe UI", Arial, sans-serif;
}

h3 {
    text-align: center;
    color: #2b2d42;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 12px;
}

h3::after {
    content: "";
    display: block;
    width: 50px;
    height: 3px;
    background: #ff6b35;
    margin: 8px auto 0;
    border-radius: 2px;
}

.error-box {
    background: #fdecea;
    color: #c0392b;
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 16px;
    border: 1px solid #f5c6cb;
}

.form-group {
    margin-bottom: 16px;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    box-sizing: border-box;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: #ff6b35;
    box-shadow: 0 0 0 3px rgba(255,107,53,0.15);
}

.form-control::placeholder {
    color: #aaa;
}

/* ô bị lỗi thì viền đỏ */
.form-control.is-invalid {
    border-color: #e63946;
    background: #fff8f8;
}

.form-control.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(230,57,70,0.15);
}

.error-text {
    display: block;
    color: #e63946;
    font-size: 12.5px;
    margin-top: 5px;
    padding-left: 2px;
}

.btn-submit {
    width: 100%;
    padding: 13px;
    background: #ff6b35;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-submit:hover {
    background: #e55a2b;
}

.form-wrapper p {
    text-align: center;
    margin-top: 18px;
    font-size: 14px;
    color: #555;
}

.form-wrapper p a {
    color: #ff6b35;
    font-weight: 600;
    text-decoration: none;
}

.form-wrapper p a:hover {
    text-decoration: underline;
}
</style>

<h3>Đăng ký thành viên</h3>

<div class="form-wrapper">

<?php if(!empty($err_chung)): ?>
    <div class="error-box"><?php echo $err_chung; ?></div>
<?php endif; ?>

<form action="" method="POST">

    <div class="form-group">
        <input type="text" name="hovaten" placeholder="Họ và tên"
               class="form-control <?php echo $err_hovaten ? 'is-invalid' : ''; ?>"
               value="<?php echo htmlspecialchars($val_hovaten); ?>">
        <?php if($err_hovaten): ?>
            <span class="error-text"><?php echo $err_hovaten; ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <input type="text" name="email" placeholder="Email"
               class="form-control <?php echo $err_email ? 'is-invalid' : ''; ?>"
               value="<?php echo htmlspecialchars($val_email); ?>">
        <?php if($err_email): ?>
            <span class="error-text"><?php echo $err_email; ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <input type="text" name="dienthoai" placeholder="Điện thoại"
               class="form-control <?php echo $err_dienthoai ? 'is-invalid' : ''; ?>"
               value="<?php echo htmlspecialchars($val_dienthoai); ?>">
        <?php if($err_dienthoai): ?>
            <span class="error-text"><?php echo $err_dienthoai; ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <input type="text" name="diachi" placeholder="Địa chỉ"
               class="form-control"
               value="<?php echo htmlspecialchars($val_diachi); ?>">
    </div>

    <div class="form-group">
        <input type="password" name="matkhau" placeholder="Mật khẩu"
               class="form-control <?php echo $err_matkhau ? 'is-invalid' : ''; ?>">
        <?php if($err_matkhau): ?>
            <span class="error-text"><?php echo $err_matkhau; ?></span>
        <?php endif; ?>
    </div>

    <input type="submit" name="dangky" value="Đăng ký" class="btn-submit">

</form>

<p>
    Đã có tài khoản? 
    <a href="index.php?quanly=dangnhap">Đăng nhập</a>
</p>
</div>