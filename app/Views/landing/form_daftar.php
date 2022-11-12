<?= $this->extend("/layout/template_depan.php"); ?>
<?= $this->section("konten"); ?>
<div style="margin-top: 110px;">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-8">
                <!-- <h3 class="mb-3 text-center">Formulir Pendaftaran</h3> -->
                <div class="card o-hidden border-0 shadow-lg mb-2">
                    <div style="background-color: #2487ce;" class="card-header text-white text-center">
                        <strong>Formulir Pendaftaran</strong>
                    </div>
                    <div class="card-body">
                        <!-- Form Pendafaran -->
                        <div id="alertError" class="row" style="display: none;">
                            <div class="col-12">
                                <div class="alert alert-warning errortext" role="alert">
                                </div>
                            </div>
                        </div>
                        <?= form_open("/pemohon/proses_daftar", ['class' => 'formdaftar']); ?>
                        <?= csrf_field() ?>
                        <!-- NIK -->
                        <div class="form-group row">
                            <label for="NIK" class="col-sm-4 col-form-label">NIK</label>
                            <div class="col-sm-8">
                                <div class="row px-3">
                                    <input type="text" name="NIK" class="col-sm-9 form-control" id="NIK">
                                    <button type="button" role="button" id="btn_ceknik" class="btn btn-info btn-xs col-sm-3 form-control btn-ceknik">Cek NIK</button>
                                </div>
                            </div>

                        </div>
                        <div class="invalid-feedback invalidNIK text-center"></div>

                        <div class="formulir-biodata">

                        </div>
                        <hr class="py-3">
                        <!-- ini button -->
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-auto">
                                <a href="/home/index" style="min-width: 150px;" type="button" class="btn btn-secondary text-white">Batal</a>
                                <button style="background-color: #2487ce; min-width: 150px;" type="submit" role="button" class="btn btndaftar text-white" disabled>Daftar</button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $("#btn_ceknik").click(function() {
        var nik = $("#NIK").val();
        // console.log(nik);
        $.ajax({
            url: "<?= site_url('dinamis/cek_biodata_nik'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                nik: nik
            },
            success: function(response) {
                $('.formulir-biodata').html(response.data);
                $('.btndaftar').prop('disabled', false);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>


<script {csp-script-nonce}>
    $(document).ready(function() {
        $('.formdaftar').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btndaftar').prop('disabled', true);
                    $('.btndaftar').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btndaftar').prop('disabled', false);
                    $('.btndaftar').html('Daftar');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.Nik) {
                            swal("Mohon Maaf!", response.error.Nik, "error");
                        } else if (response.error.nama) {
                            swal("Mohon Maaf!", response.error.nama, "error");
                        } else if (response.error.tempatlahir) {
                            swal("Mohon Maaf!", response.error.tempatlahir, "error");
                        } else if (response.error.tgLahir) {
                            swal("Mohon Maaf!", response.error.tgLahir, "error");
                        } else if (response.error.alamat) {
                            swal("Mohon Maaf!", response.error.alamat, "error");
                        } else if (response.error.kecamatan) {
                            swal("Mohon Maaf!", response.error.kecamatan, "error");
                        } else if (response.error.kelurahan) {
                            swal("Mohon Maaf!", response.error.kelurahan, "error");
                        } else if (response.error.agama) {
                            swal("Mohon Maaf!", response.error.agama, "error");
                        } else if (response.error.telepon) {
                            swal("Mohon Maaf!", response.error.telepon, "error");
                        } else if (response.error.gender) {
                            swal("Mohon Maaf!", response.error.gender, "error");
                            // $('.errorGender').html(response.error.gender);
                        }
                        $("input[name='csrf_test_name']").val(response.error.token);
                    }
                    if (response.a) {
                        if (response.a.b) {
                            swal("Mohon Maaf!", response.a.b, "error");
                            $('.errortext').html(response.a.b);
                            $("input[name='csrf_test_name']").val(response.a.token);
                        } else {
                            $('#alertError').css("display", "none");
                            $('.errortext').html('');
                        }
                    }
                    if (response.berhasil) {
                        swal({
                            title: "Berhasil",
                            text: "Selamat Anda berhasil terdaftar. Silakan melanjutkan ajuan!",
                            icon: "success",
                            button: "Ok",
                        }).then((value) => {
                            window.location = response.berhasil.link;
                        });
                        // window.location = response.berhasil.link;
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

            return false;
        });
    });
</script>
<?= $this->endSection(); ?>