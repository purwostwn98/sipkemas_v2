<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>
<?php
$session = \Config\Services::session();
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User Management</h1>
    <div class="col-auto">
        <button data-toggle="modal" data-target="#warningModal" type="button" class="btn btn-xs btn-primary btnindividu"><i class="fa fa-user text-110 align-text-bottom mr-1"></i> | Tambah User</button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="alert alert-success <?= ($session->getFlashdata('berhasilUpdate')) ? '' : 'not-show' ?>">
            <strong>Success!</strong> Data berhasil diupdate.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="collapse show" id="collapseExample1" data-parent="#accordion">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table style="font-size: 14px;" class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead>
                                            <tr class="text-center" role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 10px;">No</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 30px;">Pengguna</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 45px;">Level</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 45px;">Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 30px;">Telepon</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 35px;">Username</th>
                                                <th aria-controls="dataTable" rowspan="1" colspan="1" style="width: 10px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($muser as $user) : ?>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1 text-center"><?= $no + 1; ?></td>
                                                    <td><?= $user['Namauser']; ?></td>
                                                    <td><?= $user['PrivUser']; ?></td>
                                                    <td><?= $user['email']; ?></td>
                                                    <td><?= $user['telepon']; ?></td>
                                                    <td><?= $user['User']; ?></td>
                                                    <td class="text-center">
                                                        <a href="/kesra/editUser?kode=<?= $user['idUser']; ?>" class="btn btn-warning btn-circle">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <input type="hidden" class="csrf_input" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                        <button onclick="hapus('<?= $user['idUser']; ?>')" class="btn btn-danger btn-circle">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal tambah cpl -->
<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 800px;">
        <div class="modal-content border-width-0 border-t-4 bg-primary- px-3">
            <div class="modal-header py-2">
                <i class="bg-white fas fa-exclamation-circle mb-n4 mx-auto fa-3x text-primary-m2"></i>
            </div>
            <div class="modal-body text-center">
                <p class="text-primary-d1 text-130 mt-3">
                    Tambah User
                </p>
            </div>
            <?= form_open("/kesra/doTambahUser", ['class' => 'form-user']); ?>
            <?= csrf_field(); ?>
            <div class="form-group row">
                <div class="col-sm-3 col-form-label text-sm-right pr-0">
                    <label for="id-form-field-1" class="mb-0">Level User</label>
                </div>
                <div class="col-sm-9">
                    <select class="form-control" id="level" name="privUser" required>
                        <option value="" selected disabled>Pilih level</option>
                        <?php foreach ($privUser as $key => $priv) { ?>
                            <option value="<?= $priv['idPrivUser']; ?>"><?= $priv['PrivUser']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div id="lbg" class="user_lembaga">
                <input type="hidden" name="lembaga" value="pemerintah">
            </div>
            <div class="form-group row">
                <div class="col-sm-3 col-form-label text-sm-right pr-0">
                    <label for="id-form-field-1" class="mb-0">Nama Pengguna</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="pengguna" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 col-form-label text-sm-right pr-0">
                    <label for="id-form-field-1" class="mb-0">Username</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 col-form-label text-sm-right pr-0">
                    <label for="id-form-field-1" class="mb-0">Password</label>
                </div>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password_validation" aria-describedby="emailHelp" name="password" required>
                    <div class="password_required">
                        <small class="form-text kecil"><i class="fa fa-times" aria-hidden="true"></i> <span class="text-muted"> Minimal satu huruf kecil</span></small>
                        <small class="form-text kapital"><i class="fa fa-times" aria-hidden="true"></i> <span class="text-muted"> Minimal satu huruf kapital</span></small>
                        <small class="form-text angka"><i class="fa fa-times" aria-hidden="true"></i><span class="text-muted"> Minimal satu angka</span></small>
                        <small class="form-text panjang"><i class="fa fa-times" aria-hidden="true"></i><span class="text-muted"> Minimal 8 karakter</span></small>
                    </div>
                    <input type="hidden" value="" name="pass_validation" id="pass_validation">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 col-form-label text-sm-right pr-0">
                    <label for="id-form-field-1" class="mb-0">Confirm Password</label>
                </div>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="confirm_password" required>
                </div>
            </div>
            <div class="modal-footer bg-white justify-content-between px-0 py-3">
                <button type="button" class="btn btn-md px-2 px-md-4 btn-secondary" data-dismiss="modal">
                    <i class="fas fa-undo-alt mr-1 text-danger-m2"></i>
                    Cancel
                </button>
                <button style="pointer-events: none;" type="submit" class="btn btn-md px-2 px-md-4 btn-primary btn-simpan-user">
                    Simpan
                    <i class="fa fa-arrow-right ml-1 text-success-m2"></i>
                </button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
    $('#level').change(function() {
        var level = $(this).val();
        if (level == 2 || level == 5) {
            $.ajax({
                url: "/dinamis/load_lbg_user",
                type: "POST",
                dataType: "json",
                data: {
                    level: level
                },
                success: function(response) {
                    $('#lbg').html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        } else {
            $('#lbg').html('<input type="hidden" name="lembaga" value="pemerintah">');
        }
    });
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
                $('.btn-simpan-user').css('pointer-events', 'auto');
            } else {
                $('.btn-simpan-user').css('pointer-events', 'none');
            }
        })
    });
</script>

<script>
    $(document).ready(function() {
        $('.form-user').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btn-simpan-user').attr('disable', 'disabled');
                    $('.btn-simpan-user').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn-simpan-user').removeAttr('disable', 'disabled');
                    $('.btn-simpan-user').html('Simpan <i class="fa fa-arrow-right ml-1 text-success-m2"></i>');
                },
                success: function(response) {
                    if (response.berhasil) {
                        swal("Berhasil!", response.berhasil.pesan, "success").then((value) => {
                            location.reload();
                        });
                    } else if (response.gagal) {
                        swal("Gagal!", response.berhasil.gagal, "error").then((value) => {
                            location.reload();
                        });
                    } else if (response.error) {
                        if (response.error.pengguna) {
                            swal("Gagal!", response.error.pengguna, "error").then((value) => {
                                $("input[name='csrf_test_name']").val(response.error.token);
                            });
                        } else if (response.error.username) {
                            swal("Gagal!", response.error.username, "error").then((value) => {
                                $("input[name='csrf_test_name']").val(response.error.token);
                            });
                        } else if (response.error.password) {
                            swal("Gagal!", response.error.password, "error").then((value) => {
                                $("input[name='csrf_test_name']").val(response.error.token);
                            });
                        } else if (response.error.lembaga) {
                            swal("Gagal!", response.error.lembaga, "error").then((value) => {
                                $("input[name='csrf_test_name']").val(response.error.token);
                            });
                        } else if (response.error.confirm_password) {
                            swal("Gagal!", response.error.confirm_password, "error").then((value) => {
                                $("input[name='csrf_test_name']").val(response.error.token);
                            });
                        } else {
                            swal("Gagal!", 'Pastikan semua data diisi dengan benar!', "error").then((value) => {
                                $("input[name='csrf_test_name']").val(response.error.token);
                            });
                        }

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

<script>
    function hapus(idUser) {
        var csrfName = $('.csrf_input').attr('name'); // CSRF Token name
        var csrfHash = $('.csrf_input').val(); // CSRF hash
        swal({
                title: "Peringatan!",
                text: "Anda yakin ingin menghapus user?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?= site_url('kesra/doHapusUser'); ?>",
                        type: "POST",
                        dataType: "json",
                        data: {
                            id_user: idUser,
                            [csrfName]: csrfHash
                        },
                        success: function(response) {
                            if (response.berhasil) {
                                swal("Berhasil!", response.berhasil, "success").then((value) => {
                                    location.reload();
                                });
                            } else if (response.gagal) {
                                swal("Gagal!", response.gagal, "danger").then((value) => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                    return false;
                } else {
                    return false;
                }
            });
    }
</script>

<?= $this->endSection(); ?>