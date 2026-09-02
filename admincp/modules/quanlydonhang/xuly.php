<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;
require('../../../Carbon/Carbon-3.11.1/autoload.php');
include('../../config/config.php');
   if(isset($_GET['cart_status'])&&isset($_GET['code'])){
    $status = $_GET['cart_status'];
    $code = $_GET['code'];
    $sql = mysqli_query($mysqli,"UPDATE tbl_cart SET cart_status='0' WHERE code_cart='".$code."'");
    header('Location:../../index.php?action=quanlydonhang&query=lietke'); 
   }
   else if (isset($_POST['update_cart'])) {
    $code_cart = $_POST['code_cart'];
    $tinhtrangdonhang = $_POST['tinhtrangdonhang'];
    $sql_update_tinhtrangdonhang = mysqli_query($mysqli, "UPDATE tbl_cart SET cart_status='$tinhtrangdonhang' WHERE code_cart='$code_cart'");
    header('Location:../../index.php?action=quanlydonhang&query=lietke'); 
}
?>
