<?php
$session = \Config\Services::session();
?>
<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>
<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
    <div class="col-lg-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="col-auto">
        <div class="row">
            <span class="text-primary"><?= $tglAwal; ?> - <?= $tglAkhir; ?> </span>
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-2" data-toggle="modal" data-target="#filterModal">
                <i class="fas fa-search fa-sm text-white-50"></i> Filter Tanggal
            </button>
            <!-- Modal -->
            <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title text-white" id="filterModalLabel"><strong>Filter tanggal</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" id="formFilter" action="/<?= $halaman; ?>/dashboard">
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="inputAddress">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="inputAddress" name="tgAwal" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="inputAddress2" name="tgAkhir" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btnFilter" name="btnFilter">Filter</button>
                                <a href="/<?= $halaman; ?>/dashboard?hpsFilter=noFilter" role="button" class="btn btn-primary">Hapus Filter</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <input type="hidden" name="filterTgl" value="filter">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- button Ekspor pdf -->
            <a href=" /<?= $halaman; ?>/eksporpdf?filter=<?= $filter; ?>&tgAwal=<?= $norm_tglAwal; ?>&tgAkhir=<?= $norm_tglAkhir; ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm ml-2 btnPdf" name="btnPdf">
                <i class="fa fa-file-pdf fa-sm text-white-50"></i> Ekspor PDF
            </a>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Ajuan dalam proses -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Ajuan dalam proses
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countProses; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Ajuan Selesai
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $hasil = $countDitolak + $countDisetujui;
                                                                            echo $hasil; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<!-- Content Row  Total Dana-->
<div class="row">
    <div class="col-12 mb-4">
        <div class="card bg-danger text-white shadow">
            <div class="card-body text-center">
                Total Dana Disetujui: <span style="font-weight: bold;">Rp. <?= number_format((float)$totalDana['nilaiDisetujui'], 0, ',', '.'); ?></span>
            </div>
        </div>
    </div>
</div>

<!-- Statistik -->
<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-xl-8">
        <div class="card shadow mb-4">
            <div class="card-header  bg-success py-3">
                <h6 class="m-0 font-weight-bold text-white">Statistik Bantuan</h6>
            </div>

            <!-- Card Body -->
            <div class="card-body">

                <!--<canvas id="myAreaChart"></canvas> -->
                <div align='center' id="chart2"></div><br>

            </div>
        </div>
    </div>

    <!-- Pie Mitra -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header  bg-warning py-3">
                <h6 class="m-0 font-weight-bold text-white">Statistik Forum Kesra</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="pieMitra"></canvas>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- Page level plugins -->
<script src="<?= base_url(); ?>/vendor/chart.js/Chart.min.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    <?php if ($session->get('privUser') != 5) { ?>
        // Pie Chart Example
        var ctx = document.getElementById("pieMitra");
        var pieMitra = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [<?php
                            foreach ($daftarMitra as $daf) {
                                echo '"' . $daf['NamaMitra'] . '",';
                            } ?>],
                datasets: [{
                    data: [<?php for ($p = 0; $p < count($countMitra); $p++) {
                                echo '"' . $countMitra[$p] . '",';
                            } ?>],
                    backgroundColor: ['#1cc88a', '#36b9cc', '#e74a3b', '#f6c23e'],
                    hoverBackgroundColor: ['#6b231c', '#0c5c3f', '#2c9faf', '#947526'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    caretPadding: 10,
                },
                legend: {
                    display: true,

                },
                cutoutPercentage: 80,
            },
        });
    <?php } ?>



    new Highcharts.Chart({
        chart: {
            type: 'bar',
            renderTo: 'chart2'
        },
        title: {
            text: 'Grafik Ajuan Bantuan Kelurahan'
        },
        subtitle: {
            text: 'per Program Bantuan'
        },
        xAxis: {
            categories: [<?php
                            foreach ($daftarBantuan as $daf) {
                                echo '"' . $daf['namaProgram'] . '",';
                            } ?>],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' proposal'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Ajuan',
            data: [<?php for ($p = 0; $p < count($countBantuan); $p++) {
                        echo  $countBantuan[$p] . ',';
                    } ?>],
            color: '#fc145e'
        }]

    });
</script>
<?= $this->endSection(); ?>