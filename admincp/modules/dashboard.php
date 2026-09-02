<p>Thống kê đơn hàng : <span id="text-date"></span></p>

<div class="thongke-filter" style="margin-bottom: 15px; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
    <select id="loai-thongke" class="form-control" style="width:auto;">
        <option value="day">Theo ngày</option>
        <option value="month">Theo tháng</option>
        <option value="year">Theo năm</option>
    </select>

    <input type="text" id="tu-ngay" class="form-control" placeholder="Từ ngày" style="width:150px;" />
    <input type="text" id="den-ngay" class="form-control" placeholder="Đến ngày" style="width:150px;" />

    <button id="btn-locke" type="button" class="btn btn-primary">Lọc</button>
</div>

<div id="chart" style="height: 250px;"></div>

<!-- flatpickr cho date picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
$(document).ready(function(){

    flatpickr("#tu-ngay", { dateFormat: "Y-m-d" });
    flatpickr("#den-ngay", { dateFormat: "Y-m-d" });

    var char = new Morris.Area({
        element: 'chart',
        parseTime: false,
        xkey: 'date',
        ykeys: ['order','sales','quantity'],
        labels: ['Đơn hàng','Doanh thu','Số lượng bán ra']
    });

    thongke('day', '', '');

    function thongke(loai, tuNgay, denNgay) {
        $.ajax({
            url: "modules/thongke.php",
            method: "POST",
            data: {
                loai: loai,
                tu_ngay: tuNgay,
                den_ngay: denNgay
            },
            dataType: "JSON",
            success: function(data) {
                if(data.length === 0){
                    $("#text-date").text("Không có dữ liệu trong khoảng thời gian này");
                    char.setData([]);
                    return;
                }
                char.setData(data);

                var textLoai = loai == 'day' ? 'Theo ngày' : (loai == 'month' ? 'Theo tháng' : 'Theo năm');
                $("#text-date").text(textLoai);
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
    }

    $("#btn-locke").on("click", function(){
        var loai = $("#loai-thongke").val();
        var tuNgay = $("#tu-ngay").val();
        var denNgay = $("#den-ngay").val();
        thongke(loai, tuNgay, denNgay);
    });

});
</script>