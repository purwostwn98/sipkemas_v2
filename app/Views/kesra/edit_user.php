<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>
<?php
$session = \Config\Services::session();
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
</div>
<div class="row">
    <div class="col-lg-12">
        <!-- Data Program -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
            </div>
            <div class="card-body">
                <?= form_open("/kesra/doEditUser", ['class' => 'formEditUser']); ?>
                <?= csrf_field(); ?>
                <!-- <form> -->
                <input type="hidden" name="idUser" value="<?= $dataUser['idUser']; ?>">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control border-left-warning" id="staticEmail" value="<?= $dataUser['PrivUser']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namaProgram" class="col-sm-2 col-form-label">Pengguna</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($session->getFlashdata('errorPengguna')) ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" id="pengguna" value="<?= $dataUser['Namauser']; ?>" name="pengguna" required>
                        <div class="invalid-feedback invalidPengguna text-left">
                            <?php echo session()->getFlashdata('errorPengguna'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namaProgram" class="col-sm-2 col-form-label">No. Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control border-left-primary" id="telepon" value="<?= $dataUser['telepon']; ?>" name="telepon">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namaProgram" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control border-left-primary" id="email" value="<?= $dataUser['email']; ?>" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desProgram" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($session->getFlashdata('errorUser')) ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" id="username" value="<?= $dataUser['User']; ?>" name="username" required>
                        <div class="invalid-feedback invalidUser text-left">
                            <?php echo session()->getFlashdata('errorUser'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desProgram" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control <?= ($session->getFlashdata('errorPassword')) ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" id="password_validation" name="new_pass" required>
                        <div class="invalid-feedback invalidPassword text-left">
                            <?php echo session()->getFlashdata('errorPassword'); ?>
                        </div>
                        <div class="password_required">
                            <small class="form-text kecil"><i class="fa fa-times" aria-hidden="true"></i> <span class="text-muted"> Minimal satu huruf kecil</span></small>
                            <small class="form-text kapital"><i class="fa fa-times" aria-hidden="true"></i> <span class="text-muted"> Minimal satu huruf kapital</span></small>
                            <small class="form-text angka"><i class="fa fa-times" aria-hidden="true"></i><span class="text-muted"> Minimal satu angka</span></small>
                            <small class="form-text panjang"><i class="fa fa-times" aria-hidden="true"></i><span class="text-muted"> Minimal 8 karakter</span></small>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desProgram" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control <?= ($session->getFlashdata('errorConfPassword')) ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" id="password_confirm" name="conf_pass" required>
                        <div class="invalid-feedback invalidPassword text-left">
                            <?php echo session()->getFlashdata('errorConfPassword'); ?>
                        </div>
                    </div>
                </div>
                <!-- Button -->
                <div class="d-sm-flex align-content-center justify-content-center mb-3">
                    <a onclick="history.go(-1)" class="btn btn-md btn-secondary btn-icon-split mr-3">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left fa-md"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
                    <button type="submit" style="pointer-events: none;" class="btn btn-md btn-success btn-icon-split btnUpdate">
                        <span class="icon text-white-50">
                            <i class="fas fa-check fa-md"></i>
                        </span>
                        <span class="text">Simpan Perubahan</span>
                    </button>
                </div>
                <!-- </form> -->
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript">
    function updateUser() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: $(".formEditUser").attr('action'),
            data: $(".formEditUser").serialize(),
            beforeSend: function() {
                $('.btnUpdate').prop('disabled', true);
                $('.btnUpdate').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btnUpdate').prop('disabled', false);
                $('.btnUpdate').html("<span class='icon text-white-50'><i class='fas fa-check fa-md'></i></span><span class='text'>Simpan Perubahan</span>");
            },
            success: function(response) {
                if (response.berhasil) {
                    swal("Berhasil!", response.berhasil, "success").then((value) => {
                        window.location = response.link;
                    });
                } else if (response.gagal) {
                    swal("Gagal!", response.gagal, "danger").then((value) => {
                        window.location = response.linkgagal;
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    }
</script>


<script>
    $('#password_validation').on('focus', function() {
        $('#password_required').slideDown();
    });
    $('#password_validation').on('blur', function() {
        $('#password_required').slideUp();
    });
    $('#password_validation').on('keyup', function() {
        passValue = $(this).val();

        if (passValue.match(/[a-z]/g)) {
            $('.kecil').html('<i class="fa fa-check text-success" aria-hidden="true"></i> <span class="text-success"> Minimal satu huruf kecil</span></small>')
            $('.kecil').addClass('active');
        } else {
            $('.kecil').html('<i class="fa fa-times" aria-hidden="true"></i> <span class="text-muted"> Minimal satu huruf kecil</span></small>')
            $('.kecil').removeClass('active');
        }
        if (passValue.match(/[A-Z]/g)) {
            $('.kapital').html('<i class="fa fa-check text-success" aria-hidden="true"></i> <span class="text-success"> Minimal satu huruf kapital</span></small>')
            $('.kapital').addClass('active');
        } else {
            $('.kapital').html('<i class="fa fa-times" aria-hidden="true"></i> <span class="text-muted"> Minimal satu huruf kapital</span></small>')
            $('.kapital').removeClass('active');
        }
        if (passValue.match(/[0-9]/g)) {
            $('.angka').html('<i class="fa fa-check text-success" aria-hidden="true"></i> <span class="text-success"> Minimal satu angka</span></small>')
            $('.angka').addClass('active');
        } else {
            $('.angka').html('<i class="fa fa-times" aria-hidden="true"></i> <span class="text-muted"> Minimal satu angka</span></small>')
            $('.angka').removeClass('active');
        }
        if (passValue.length >= 8) {
            $('.panjang').html('<i class="fa fa-check text-success" aria-hidden="true"></i> <span class="text-success"> Minimal 8 karakter</span></small>')
            $('.panjang').addClass('active');
        } else {
            $('.panjang').html('<i class="fa fa-times" aria-hidden="true"></i> <span class="text-muted"> Minimal 8 karakter</span></small>')
            $('.panjang').removeClass('active');
        }

        $('small').each(function(index, el) {
            if ($(this).hasClass('active')) {
                $('.btnUpdate').css('pointer-events', 'auto');
            } else {
                $('.btnUpdate').css('pointer-events', 'none');
            }
        })
    });
</script>

<?= $this->endSection(); ?>