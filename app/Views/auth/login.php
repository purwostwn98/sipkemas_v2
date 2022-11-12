<?php
$session = \Config\Services::session();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?= base_url(); ?>/assets/img/logo_pms.png" rel="icon" type="image/gif">
    <title>Sipkemas - Masuk</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-white">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img style="width: 100%;" src="<?= base_url(); ?>/img/balaikota1.jpeg" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <?= form_open(base_url() . "/gerbangska/cekuser", ['class' => 'formlogin user']); ?>
                                    <!-- <form action="/gerbangska/cekuser" method="POST"> -->
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <input name="User" type="text" class="form-control form-control-user <?= ($session->getFlashdata('errorUser')) ? 'is-invalid' : '' ?>" id="user" aria-describedby="emailHelp" placeholder="Masukkan Username" value="<?= old('User'); ?>">
                                        <div class="invalid-feedback invalidUser text-center">
                                            <?php echo session()->getFlashdata('errorUser'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="Password" type="password" class="form-control form-control-user <?= ($session->getFlashdata('errorPassword')) ? 'is-invalid' : '' ?>" id="password" placeholder="Password" value="<?= old('Password'); ?>">
                                        <div class=" invalid-feedback invalidUser text-center">
                                            <?php echo session()->getFlashdata('errorPassword'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group" align="center">
                                        <label align="center" for="jawabCpt"><?= $text; ?></label>
                                        <input name="jawabCpt" type="number" class="form-control form-control-user <?= ($session->getFlashdata('errorHitung')) ? 'is-invalid' : '' ?>" id="hitung" placeholder="Jawaban">
                                        <input name="hslbenar" type="hidden" value="<?= md5($hasil); ?>">
                                        <div class="invalid-feedback invalidUser text-center">
                                            <?php echo session()->getFlashdata('errorHitung'); ?>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                    <button type="submit" class="btn btn-primary btn-user btn-block btnlogin">
                                        Login
                                    </button>
                                    <hr>
                                    <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    <!-- </form> -->
                                    <?= form_close(); ?>

                                    <!-- <hr> -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/js/sb-admin-2.min.js"></script>

    <script>
        // $(document).ready(function() {
        //     $('.formlogin').submit(function(e) {
        //         e.preventDefault();
        //         $.ajax({
        //             type: "post",
        //             url: $(this).attr('action'),
        //             data: $(this).serialize(),
        //             dataType: "json",
        //             beforeSend: function() {
        //                 $('.btnlogin').prop('disabled', true);
        //                 $('.btnlogin').html('<i class="fa fa-spin fa-spinner"></i>');
        //             },
        //             complete: function() {
        //                 $('.btnlogin').prop('disabled', false);
        //                 $('.btnlogin').html('Login');
        //             },
        //             success: function(response) {
        //                 if (response.error) {
        //                     if (response.error.User) {
        //                         $('#user').addClass('is-invalid');
        //                         $('.invalidUser').html(response.error.User);
        //                     } else {
        //                         $('#user').removeClass('is-invalid');
        //                         $('.invalidUser').html('');
        //                     }
        //                     if (response.error.Password) {
        //                         $('#password').addClass('is-invalid');
        //                         $('.invalidPassword').html(response.error.Password);
        //                     } else {
        //                         $('#password').removeClass('is-invalid');
        //                         $('.invalidPassword').html('');
        //                     }
        //                 }
        //                 if (response.berhasil) {
        //                     return false;
        //                 }
        //             },
        //             error: function(xhr, ajaxOptions, thrownError) {
        //                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        //             }
        //         });

        //         return false;
        //     });
        // });
    </script>

</body>

</html>