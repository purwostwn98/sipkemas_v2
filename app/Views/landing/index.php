<?php
$session = \Config\Services::session();
?>
<?= $this->extend("/layout/template_depan.php"); ?>
<?= $this->section("konten"); ?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
  <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
    <div class="row justify-content-center">
      <div class="col-xl-7 col-lg-9 text-center">
        <h1>SIPKE-MAS</h1>
        <h2>Sistem Informasi Peningkatan Kesejahteraan Masyarakat</h2>
      </div>
    </div>
    <div class="text-center mb-3">
      <a href="/home/daftar" class="btn-get-started scrollto">Formulir Pendaftaran</a>
      <a href="/home/cekAjuan" class="btn-get-started scrollto">Cek Ajuan</a>
    </div>

    <div class="row icon-boxes">
      <div class="col-md-6 col-lg-3 mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
        <div class="icon-box">
          <div class="row justify-content-center">
            <div class="icon"><img src="<?= base_url(); ?>/assets/img/logo_pmi.png" alt=""></div>
          </div>
          <h4 class="title text-center"><a href="https://www.pmisurakarta.or.id/">PMI</a></h4>
          <ul class="text-left">
            <li>Griya PMI Bahagia</li>
            <li>Griya PMI Peduli</li>
            <li>Dompet Kemanusiaan</li>
          </ul>
          <p><a class="btn btn-sm btn-info" href="/home/bantuan?idMitra=1">Selengkapnya</a></p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3 mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="300">
        <div class="icon-box">
          <div class="row justify-content-center">
            <div class="icon"><img src="<?= base_url(); ?>/assets/img/lazisjateng.png" alt=""></div>
          </div>
          <h4 class="title text-center"><a href="https://lazisjateng.org/">Lazis Jateng</a></h4>
          <ul class="text-left">
            <li>Santunan Pendidikan Yatim</li>
            <li>Santunan Gizi Yatim</li>
            <li>Santunan Bunda Yatim</li>
          </ul>
          <p><a class="btn btn-sm btn-info" href="/home/bantuan?idMitra=2">Selengkapnya</a></p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3 mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="400">
        <div class="icon-box">
          <div class="row justify-content-center">
            <div class="icon"><img src="<?= base_url(); ?>/assets/img/logo_baznas.png" alt=""></div>
          </div>
          <h4 class="title text-center"><a href="https://baznas.go.id/">Baznas</a></h4>
          <ul class="text-left">
            <li>Pendidikan</li>
            <li>Ekonomi Produktif</li>
            <li>Kesehatan</li>
          </ul>
          <p><a class="btn btn-sm btn-info" href="/home/bantuan?idMitra=3">Selengkapnya</a></p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3 mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="500">
        <div class="icon-box">
          <div class="row justify-content-center">
            <div class="icon"><img src="<?= base_url(); ?>/assets/img/pms.png" alt=""></div>
          </div>
          <h4 class="title text-center"><a href="">PMS</a></h4>
          <ul class="text-left">
            <li>Bedah Rumah</li>
            <li>Olahraga</li>
            <li>Pelatihan Ekonomi Kreatif</li>
          </ul>
          <p><a class="btn btn-sm btn-info" href="/home/bantuan?idMitra=4">Selengkapnya</a></p>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero -->

<main id="main">
  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Tentang Kami</h2>
        <!-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. </p> -->
        <div class="row">
          <div class="col-lg-12">
            <p class="tentangKami">
              SipKe-Mas merupakan Sistem Informasi Peningkatan Kesejahteraan Masyarakat yang dibuat oleh <b>Sekretariat Daerah
                Bagian Kesejahteraan Rakyat</b> dengan berkoordinasi dengan Bappeda dan Dinas Sosial Kota Surakarta. Aplikasi ini
              bertujuan untuk kemudahan pengajuan bantuan sistem digital secara cepat dan tepat. Program ini menggandeng
              Forum Kesra (PMI, Lazis Jateng Cab Solo, Baznas dan PMS) yang bersinergi bersama untuk peningkatan kesejahteraan
              masyarakat di Surakarta.
            </p>
          </div>
        </div>
        <h5 class="mt-4 text-center text-white"><b>LANGKAH AJUAN PROGRAM SIPKE-MAS</b></h5>
        <!-- TimeLine -->
        <div class="row mt-5">
          <div class="col-12">
            <div class="hori-timeline" dir="ltr">
              <ul class="list-inline events">
                <li class="list-inline-item event-list">
                  <div class="px-4 text-white">
                    <div class="event-date bg-danger text-white">1</div>
                    <h5 class="font-size-16">Isi Formulir</h5>
                    <p class="text-white">Pemohon melakukan pendaftaran dengan mengisi formulir data diri.</p>
                    <div>
                      <a href="#" class="btn btn-info btn-sm">Event One</a>
                    </div>
                  </div>
                </li>
                <li class="list-inline-item event-list">
                  <div class="px-4">
                    <div class="event-date bg-warning text-white">2</div>
                    <h5 class="text-white font-size-16">Upload Syarat</h5>
                    <p class="text-white">Pemohon mengisi formulir program yang dibutuhkan dan melengkapi syarat bantuan.</p>
                    <div>
                      <a href="#" class="btn btn-info btn-sm">Event Two</a>
                    </div>
                  </div>
                </li>
                <li class="list-inline-item event-list">
                  <div class="px-4">
                    <div class="event-date bg-secondary text-white">3</div>
                    <h5 class="text-white font-size-16">Ajukan Bantuan</h5>
                    <p class="text-white">Setelah formulir diisi dengan lengkap. Klik Ajukan Bantuan.</p>
                    <div>
                      <a href="#" class="btn btn-info btn-sm">Event Three</a>
                    </div>
                  </div>
                </li>
                <li class="list-inline-item event-list">
                  <div class="px-4">
                    <div class="event-date bg-info text-white">4</div>
                    <h5 class="text-white font-size-16">Simpan No. Ajuan</h5>
                    <p class="text-white">Jika ajuan telah berhasil, pemohon mendapatkan nomor ajuan untuk disimpan secara pribadi.</p>
                    <div>
                      <a href="#" class="btn btn-info btn-sm">Event Four</a>
                    </div>
                  </div>
                </li>
                <li class="list-inline-item event-list">
                  <div class="px-4">
                    <div class="event-date bg-success text-white">5</div>
                    <h5 class="text-white font-size-16">Cek Hasil</h5>
                    <p class="text-white">Pemohon melihat proses dan hasil dengan menginput Nomor Ajuan di website.</p>
                    <div>
                      <a href="#" class="btn btn-info btn-sm">Event Five</a>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <h5 class="mt-4 text-center text-white"><b>PANDUAN PENGAJUAN PROGRAM BANTUAN</b></h5>
        <div class="row mt-2 justify-content-center">
          <div class="col-12">
            <a href="<?= base_url(); ?>/dokumen/panduan_pemohon.pdf" target="_blank" class="btn btn-warning scrollto">Download</a>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End About Section -->

  <!-- ======= Counts Section ======= -->
  <section id="counts" class="counts section-bg">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-lg-4 col-md-5 col-4 d-md-flex align-items-md-stretch">
          <div class="count-box">
            <span data-toggle="counter-up"><?= $countProgram; ?></span>
            <p>Jenis Program Bantuan</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-5 col-4 d-md-flex align-items-md-stretch">
          <div class="count-box">
            <span data-toggle="counter-up"><?= $countAjuan; ?></span>
            <p>Bantuan Tersalurkan</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-5 col-4 d-md-flex align-items-md-stretch">
          <div class="count-box">
            <span data-toggle="counter-up"><?= $countMitra; ?></span>
            <p>Forum Kesra</p>
          </div>
        </div>
      </div>
      <div class="row d-md-flex justify-content-center mt-5">
        <div class="col-md-5">
          <div class="card bg-light mb-3">
            <!-- <div class="card-header">Header</div> -->
            <div class="card-body">
              <h5 class="card-title">Ajuan berdasarkan forum kesra</h5>
              <canvas id="myChart2"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card bg-light mb-3">
            <!-- <div class="card-header">Header</div> -->
            <div class="card-body">
              <h5 class="card-title">Ajuan berdasarkan program</h5>
              <canvas id="myChart"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="row bg-white p-3">
        <div class="col-12 d-md-flex align-items-md-stretch mt-3">
          <!-- <div id="linechart_material"></div> -->
          <canvas style="max-height: 150rem;" id="linechart"></canvas>
        </div>
      </div>
    </div>
  </section>

  <!-- End Counts Section -->

</main><!-- End #main -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const labels = [
    <?php foreach ($dataProgram as $program => $jml) : ?> "<?= $program; ?>",
    <?php endforeach; ?>
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Ajuan disetujui',
      backgroundColor: [
        'rgba(255, 99, 132)',
      ],
      // borderColor: 'rgb(255, 99, 132)',
      data: [
        <?php foreach ($dataProgram as $program => $jml) : ?> <?= $jml; ?>,
        <?php endforeach; ?>
      ],
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {}
  };
</script>

<script>
  const labels2 = [
    <?php foreach ($dataMitra as $mitra => $jmlAjuan) : ?> "<?= $mitra; ?>",
    <?php endforeach; ?>
  ];

  const data2 = {
    labels: labels2,
    datasets: [{
      label: 'Ajuan disetujui',
      backgroundColor: [
        'rgba(255, 99, 132)',
        'rgb(153, 102, 255)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)'
      ],
      // borderColor: 'rgb(255, 99, 132)',
      data: [
        <?php foreach ($dataMitra as $mitra => $jmlAjuan) : ?> <?= $jmlAjuan; ?>,
        <?php endforeach; ?>
      ],
    }]
  };

  const config2 = {
    type: 'pie',
    data: data2,
    // options: {}
  };
</script>

<script>
  const labels3 = [
    <?php foreach ($jumlah_timeseries as $tahun => $jml) : ?> "<?= $tahun; ?>",
    <?php endforeach; ?>
  ];

  const data3 = {
    labels: labels3,
    datasets: [{
      label: 'Ajuan disetujui berdasarkan tahun',
      backgroundColor: [
        'rgba(255, 99, 132)',
      ],
      // borderColor: 'rgb(255, 99, 132)',
      data: [
        <?php foreach ($jumlah_timeseries as $tahun => $jml) : ?> <?= $jml; ?>,
        <?php endforeach; ?>
      ],
    }]
  };

  const config3 = {
    type: 'bar',
    data: data3,
    options: {}
  };
</script>

<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

  const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
  );

  const myChart3 = new Chart(
    document.getElementById('linechart'),
    config3
  );
</script>
<?= $this->endSection(); ?>