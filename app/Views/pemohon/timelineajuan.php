<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">> Timeline Ajuan</h1>
</div>

<div class="card border-left-info shadow h-100">
    <div class="card-body">
        <h5 class="text-info"><i class="fas fa-exclamation-triangle"></i></span> INFORMASI TAHAPAN</h5>
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <p>
                    <span class="badge badge-warning">&nbsp;</span> menunjukkan tahapan belum dilakukan. <br>
                    <span class="badge badge-success">&nbsp;</span> menunjukkan tahapan sudah diselesaikan. <br>
                    <span class="badge badge-info">&nbsp;</span> menunjukkan tahapan informasi.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <!-- Timeline -->
            <ul class="timeline">
                <li class="timeline-item bg-white rounded ml-3 p-4 shadow">
                    <div class="timeline-arrow"></div>
                    <a href="#" class="h5 mb-0 text-info">Data E-SIK</a> <br>
                    <span style="border-radius: 5px;" class="small text-white bg-info p-1"><i class="fa fa-clock-o mr-1"></i>Terdaftar</span>
                    <p class="text-small mt-2 font-weight-light">Jika status data E-SIK belum terdaftar silahkan menghubungi kelurahan setempat</p>
                </li>
                <li class="timeline-item bg-white rounded ml-3 p-4 shadow">
                    <div class="timeline-arrow"></div>
                    <a class="h5 mb-0 text-warning" href="/kelurahan/form_ajuan">Unggah Dokumen</a>
                    <!-- <span class="small text-gray"><i class="fa fa-clock-o mr-1"></i>5 April, 2019</span> -->
                    <p class="text-small mt-2 font-weight-light">Unggah dokumen yang dibutuhkan untuk pertimbangan kami</p>
                    <ul class="text-small mt-2 font-weight-light">
                        <li>Foto Rumah</li>
                        <li>Foto Pendukung Lainnya</li>
                    </ul>
                </li>
                <li class="timeline-item bg-white rounded ml-3 p-4 shadow">
                    <div class="timeline-arrow"></div>
                    <a href="#" class="h5 mb-0 text-info">Menunggu Verifikasi</a><br>
                    <span style="border-radius: 5px;" class="small text-white bg-info p-1"><i class="fa fa-clock-o mr-1"></i>Belum Diverifikasi</span>
                    <p class="text-small mt-2 font-weight-light">Mohon tunggu verifikasi data dari pihak dinsos dan Kesra</p>
                </li>
                <li class="timeline-item bg-white rounded ml-3 p-4 shadow">
                    <div class="timeline-arrow"></div>
                    <a class="h5 mb-0 text-info">Pengumuman</a><br>
                    <span style="border-radius: 5px;" class="small text-white bg-info p-1"><i class="fa fa-clock-o mr-1"></i>Menunggu</span>
                    <p class="text-small mt-2 font-weight-light">Mohon tunggu hasil seleksi dari forum kesra</p>
                </li>
            </ul><!-- End -->
        </div>
    </div>
</div>


<?= $this->endSection(); ?>