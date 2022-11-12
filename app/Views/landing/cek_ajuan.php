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

    <!-- Google ReCaptcha -->
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

    <!-- Sweat Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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

    <div style="margin-top: 110px;" class="container">
        <div class="row justify-content-md-center mb-3">
            <div class="col-lg-7 col-md-9">
                <div class="card o-hidden shadow-lg border-bottom-info mb-2">
                    <div class="card-header bg-info text-white text-center">
                        <strong>Cek Ajuan</strong>
                    </div>
                    <div class="card-body">
                        <!-- Form Pendafaran -->
                        <div id="alertError" class="row" style="display: none;">
                            <div class="col-12">
                                <div class="alert alert-warning errortext" role="alert">
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="/pemohon/prosesCekAjuan" class="cekAjuan">
                            <?= csrf_field(); ?>
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-warning" role="alert">
                                    <?= session()->getFlashdata('pesan'); ?>
                                </div>
                            <?php endif; ?>
                            <!-- No Ajuan -->
                            <div class="form-group row">
                                <label for="noAjuan" class="col-sm-4 col-form-label">Masukkan No. Ajuan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="noAjuan" class="form-control" id="noAjuan" placeholder="Nomor Ajuan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jawaban" class="col-sm-4 col-form-label"><?= $text; ?></label>
                                <div class="col-sm-8">
                                    <input type="number" name="jawabCpt" class="form-control" id="jawaban" placeholder="Jawaban">
                                    <input type="hidden" name="hslbenar" class="form-control" value="<?= md5($hasil); ?>">
                                </div>
                            </div>
                            <!-- <div class="form-group row justify-content-md-center">
                                <div class="g-recaptcha" data-sitekey="6LdlXhwbAAAAACTiuY1WoMackLIWSIVG6FDH6Do8"></div>
                                <span class="text-danger" id="captcha_error"></span>
                            </div> -->
                            <div class="form-group row justify-content-md-center">
                                <div class="col-md-auto">
                                    <a href="/home/index" role="button" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-info btnCek">Cek Ajuan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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