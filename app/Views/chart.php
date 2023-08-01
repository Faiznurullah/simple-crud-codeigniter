<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-5">
                <center><h3>Grafik Berdasarkan Harga</h3></center>
                <canvas id="myChart" width="150" height="75"></canvas>
                <select id="selectDataHarga"  class="form-select mt-3" onchange="changeChartDataHarga()" aria-label="Default select example"> 
                        <option value="tahun">Tahun</option>
                        <option value="bulan">Bulan</option>
                        <option value="minggu">Minggu</option>
                    </select>

                <a href="/" class="btn btn-primary btn-sm mt-5">Kembali</a>
            </div>

            <div class="col-xl-2"></div>

            <div class="col-xl-5">
                <div class="mt-4">
                    <center><h3>Grafik Berdasarkan Jumlah</h3></center>
                    <canvas id="myChart1" width="150" height="75"></canvas>
                    <select id="selectData"  class="form-select mt-3" onchange="changeChartData()" aria-label="Default select example"> 
                        <option value="tahun">Tahun</option>
                        <option value="bulan">Bulan</option>
                        <option value="minggu">Minggu</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var dataJumlahTahun = <?= json_encode($datajumlahtahun); ?>;
var dataJumlahBulan = <?= json_encode($datajumlahbulan); ?>;
var dataJumlahMinggu = <?= json_encode($datajumlahminggu); ?>;

var datahargaJumlahTahun = <?= json_encode($datahargajumlahtahun); ?>;
var datahargaJumlahBulan = <?= json_encode($datahargajumlahbulan); ?>;
var datahargaJumlahMinggu = <?= json_encode($datahargajumlahminggu); ?>;


var chartDataHarga = datahargaJumlahTahun;
var chartData = dataJumlahTahun;

function changeChartDataHarga() {
    var selectElement = document.getElementById("selectDataHarga");
    var selectedValue = selectElement.value;
    
    if (selectedValue === "tahun") {
        chartDataHarga = datahargaJumlahTahun;
    } else if (selectedValue === "bulan") {
        chartDataHarga = datahargaJumlahBulan;
    } else if (selectedValue === "minggu") {
        chartDataHarga = datahargaJumlahMinggu;
    }

    updateChartBiayaHarga();
}

function updateChartBiayaHarga() {
    if (window.chartInstanceBiayaHarga) {
        window.chartInstanceBiayaHarga.destroy();
    }
    
    // Membuat chart menggunakan Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    window.chartInstanceBiayaHarga = new Chart(ctx, {
        type: chartDataHarga.type,
        data: chartDataHarga.data,
        options: chartDataHarga.options
    });
}

// Panggil fungsi updateChartBiaya untuk membuat chart awal
updateChartBiayaHarga();




function changeChartData() {
    var selectElement = document.getElementById("selectData");
    var selectedValue = selectElement.value;
    
    if (selectedValue === "tahun") {
        chartData = dataJumlahTahun;
    } else if (selectedValue === "bulan") {
        chartData = dataJumlahBulan;
    } else if (selectedValue === "minggu") {
        chartData = dataJumlahMinggu;
    }

    updateChartBiaya();
}

function updateChartBiaya() {
    if (window.chartInstanceBiaya) {
        window.chartInstanceBiaya.destroy();
    }
    
    // Membuat chart menggunakan Chart.js
    var ctx = document.getElementById('myChart1').getContext('2d');
    window.chartInstanceBiaya = new Chart(ctx, {
        type: chartData.type,
        data: chartData.data,
        options: chartData.options
    });
}

// Panggil fungsi updateChartBiaya untuk membuat chart awal
updateChartBiaya();
</script>
<?= $this->endSection(); ?>
