<?php

use Carbon\Carbon;

include('../config/config.php');
require('../../Carbon/Carbon-3.11.1/autoload.php');

// Loại thống kê: day | month | year
$loai = isset($_POST['loai']) ? $_POST['loai'] : 'day';

// Khoảng thời gian lọc (mặc định 365 ngày gần nhất)
if(isset($_POST['tu_ngay']) && $_POST['tu_ngay'] != ''){
    $tuNgay = $_POST['tu_ngay'];
}else{
    $tuNgay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
}

if(isset($_POST['den_ngay']) && $_POST['den_ngay'] != ''){
    $denNgay = $_POST['den_ngay'];
}else{
    $denNgay = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
}

// Định dạng nhóm dữ liệu theo loại thống kê
switch ($loai) {
    case 'month':
        $format_sql = '%Y-%m';
        break;
    case 'year':
        $format_sql = '%Y';
        break;
    case 'day':
    default:
        $format_sql = '%Y-%m-%d';
        break;
}

$sql = "SELECT 
            DATE_FORMAT(ngaydat, '$format_sql') AS nhom,
            SUM(donhang) AS donhang,
            SUM(doanhthu) AS doanhthu,
            SUM(soluongban) AS soluongban
        FROM tbl_thongke
        WHERE ngaydat BETWEEN ? AND ?
        GROUP BY nhom
        ORDER BY MIN(ngaydat) ASC";

$stmt = $mysqli->prepare($sql);

if(!$stmt){
    echo json_encode(['error' => $mysqli->error]);
    exit();
}

$stmt->bind_param("ss", $tuNgay, $denNgay);
$stmt->execute();

$result = $stmt->get_result();

$chart_data = array();

while($val = $result->fetch_assoc()){
    $chart_data[] = array(
        'date' => $val['nhom'],
        'order' => (int)$val['donhang'],
        'sales' => (float)$val['doanhthu'],
        'quantity' => (int)$val['soluongban']
    );
}

$stmt->close();
$mysqli->close();

echo json_encode($chart_data);
exit();
?>