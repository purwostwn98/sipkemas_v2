<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SipKe-Mas Surakarta</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url(); ?>/assets/img/logo_pms.png" rel="icon">
  <link href="<?= base_url(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: OnePage - v2.2.2
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <div class="row mr-auto">
        <a href="/home/index" class="logo ml-3"><img src="<?= base_url(); ?>/assets/img/logo_pms.png" alt="" class="img-fluid"></a>
        <span style="color: #2487ce; font-size: 14px;" class="ml-1 d-none d-lg-block">
          <b>Pemerintah Kota Surakarta</b><br>
          Sekretariat Daerah Bagian Kesejahteraan Rakyat
        </span>
      </div>
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="/home/index">Home</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- End Header -->

  <main style="margin-top: 40px;" id="main">
    <section class="inner-page mt-0">
      <div class="container mt-0">
        <div class="row">
          <div class="col-12 d-sm-flex align-items-center justify-content-between mb-2">
            <h4 class="text-center mb-3 mt-0">Program <?= $mitra['keteranganMitra']; ?></h4>
            <a href="/home/daftar" style="background-color: #2487ce;" class="btn text-white">Formulir Pendaftaran</a>
          </div>
        </div>
        <div id="accordion">
          <?php $no = 0;
          foreach ($programBantuan as $program) {
            $heading = "heading_" . $no;
            $collapse = "collapse_" . $no; ?>
            <div class="card">
              <div class="card-header d-sm-flex align-items-center justify-content-between" id="<?= $heading; ?>">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#<?= $collapse; ?>" aria-expanded="true" aria-controls="<?= $collapse; ?>">
                    <?= $program['namaProgram']; ?>
                  </button>
                </h5>
                <p class="<?= ($program['StatusProgram'] == 'active') ? 'bg-success' : 'bg-danger' ?> text-white px-2 rounded-top rounded-bottom"><?= ($program['StatusProgram'] == 'active') ? 'Aktif' : 'Tidak Aktif' ?></p>
              </div>

              <div id="<?= $collapse; ?>" class="collapse" aria-labelledby="<?= $heading; ?>" data-parent="#accordion">
                <div class="card-body">
                  <p><?= $program['desBantuan']; ?></p>
                  <p><b>Syarat Pendaftaran</b></p>
                  <ul>
                    <?php for ($i = 0; $i < count($semua_syarat[$no]); $i++) { ?>
                      <li><?= $semua_syarat[$no][$i]; ?></li>
                    <?php } ?>
                  </ul>
                  <p><b>Kuota</b></p>
                  <p><?= $program['kuota']; ?></p>
                  <p><b>Periode</b></p>
                  <p><?= $program['tahun']; ?></p>
                  <p><b>Besaran Bantuan</b></p>
                  <p><?= $program['NilaiBantuan']; ?></p>
                </div>
              </div>
            </div>
          <?php $no++;
          } ?>
          <!-- <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  2. Griya PMI Peduli
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <p>Griya PMI Peduli merupakan Program PMI Kota Surakarta dalam upaya memanusiakan manusia yang tidak
                  termanusiakan yaitu merawat orang dengan gangguan jiwa (ODGJ) terlantar. Sehingga ODGJ terawat baik secara mental maupun fisik.</p>
                <p><b>Syarat Pendaftaran</b></p>
                <ul>
                  <li>Kartu Tanda Penduduk</li>
                  <li>Kartu Keluarga</li>
                  <li>Assesment (<a href="<?= base_url(); ?>/dokumen/ass_griya.pdf" target="_blank">Download</a>)</li>
                  <li>Survey</li>
                  <li>Pelaporan ke Satpol PP Kota Surakarta</li>
                  <li>Pelaporan ke Dinsos Kota Surakarta</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  3. Dompet Kemanusiaan
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <p>Dompet Kemanusiaan adalah Program PMI Kota Surakarta untuk membantu masyarakat miskin sakit di wilayah Kota Surakarta.
                  Contoh pengajuan berupa alat bantu jalan (kruk, walker, tripod dan kursi roda), home care (perawatan di rumah)/medikasi, sembako, pelayanan ambulans untuk kontrol rutin ke Rumah Sakit, dll
                </p>
                <p><b>Syarat Pendaftaran</b></p>
                <ul>
                  <li>Kartu Tanda Penduduk</li>
                  <li>Kartu Keluarga</li>
                  <li>Assessment (<a href="<?= base_url(); ?>/dokumen/ass_kemanusiaan.pdf" target="_blank">Download</a>)</li>
                  <li>KIS Pemerintah</li>
                  <li>Survey</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  4. Penanggulangan Bencana
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <p>PMI Kota Surakarta memberikan pelayanan penanggulangan bencana baik bencana alam maupun non alam.
                </p>
                <p><b>Syarat Pendaftaran</b></p>
                <p>Untuk penanggulangan bencana alam warga memberi informasi terjadinya bencana alam (darurat) melaporkan kepada
                  RT/RW/Kelurahan setempat dan ke PMI Kota Surakarta dengan menyampaikan kebutuhan apa yang mendesak misalnya tim
                  relawan /SAR, obat-obatan, pertolongan pertama tim medis, suplay air bersih, dll.
                  <br><br>
                  Untuk bencana non alam seperti covid-19 pemohon mengirimkan data lengkap dan menyampaikan kebutuhan apa yang mendesak misalnya spraying disinfektan, masker, bantuan untuk warga yang karantina, dll)
                </p>
              </div>
            </div>
          </div> -->
        </div>
        <!-- Download Dokumen PMI -->
        <?php if ($mitra['idMitra'] == 1) { ?>
          <div class="row mt-3">
            <div class="col-12 d-sm-flex align-items-center justify-content-between mb-2">
              <h5 class="text-center mb-3 mt-0">Download Assesment</h5>
            </div>
          </div>
          <div class="row">
            <ul>
              <li><a href="<?= base_url(); ?>/dokumen/ass_griya.pdf" target="_blank">Assessment Griya PMI</a></li>
              <li><a href="<?= base_url(); ?>/dokumen/ass_kemanusiaan.pdf" target="_blank">Assessment Dompet Kemanusiaan</a></li>
            </ul>
          </div>
        <?php } ?>
        <!-- Download Dokumen BAZNAS -->
        <?php if ($mitra['idMitra'] == 3) { ?>
          <div class="row mt-3">
            <div class="col-12 d-sm-flex align-items-center justify-content-between mb-2">
              <h5 class="text-center mb-3 mt-0">Download Format Surat Permohonan</h5>
            </div>
          </div>
          <div class="row">
            <ul>
              <li><a href="<?= base_url(); ?>/dokumen/format_permohonan_baznas_2.pdf" target="_blank">Format Surat Permohonan Bantuan Perorangan</a></li>
            </ul>
          </div>
        <?php } ?>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 footer-contact">
            <h4>Bagian Kesejahteraan Rakyat Sekretariat Daerah Kota Surakarta</h4>
            <p>
              Komp. Balai Kota,
              JL. Jend. Sudirman, No. 2 <br>
              Kp. Baru, Kec. Ps. Kliwon<br>
              Kota Surakarta, Jawa Tengah 57133 <br><br>
              <strong>Phone:</strong> (0271) 655398<br>
              <strong>Email:</strong> bag-kesra@surakarta.go.id<br>
              <!-- <strong>Email:</strong> info@example.com<br> -->
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="container d-md-flex py-4">
      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>Puslogin UMS</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/counterup/counterup.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url(); ?>/assets/js/main.js"></script>

</body>

</html>
<!-- 
<li>Kartu Keluarga</li>
<li>
<li>Survey</li>
<li>Pelaporan ke Satpol PP Kota Surakarta</li>
<li>Pelaporan ke Dinsos Kota Surakarta</li> -->