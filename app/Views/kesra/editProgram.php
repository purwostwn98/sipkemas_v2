<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Program</h1>
</div>
<div class="row">
    <div class="col-lg-12">
        <!-- Data Program -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Program</h6>
            </div>
            <div class="card-body">
                <?= form_open("/kesra/doEditProgram", ['class' => 'formEditProgram']); ?>
                <?= csrf_field(); ?>
                <!-- <form> -->
                <input type="hidden" name="idBantuan" value="<?= $bantuan['idBantuan']; ?>">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Kode Bantuan</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control border-left-warning" id="staticEmail" value="<?= $bantuan['kodeBantuan']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stsProgram" class="col-sm-2 col-form-label">Status Program</label>
                    <div class="col-sm-10">
                        <select name="StatusProgram" class="form-control border-left-primary" required>
                            <option <?= ($bantuan['StatusProgram'] == 'active') ? 'selected' : '' ?> value="active">Aktif</option>
                            <option <?= ($bantuan['StatusProgram'] == 'nonactive') ? 'selected' : '' ?> value="nonactive">Tidak aktif</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namaProgram" class="col-sm-2 col-form-label">Nama Program</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control border-left-primary" id="namaProgram" value="<?= $bantuan['namaProgram']; ?>" name="namaProgram" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desProgram" class="col-sm-2 col-form-label">Deskripsi Program</label>
                    <div class="col-sm-10">
                        <textarea class="form-control border-left-primary" id="desProgram" name="desBantuan" rows="4"><?= $bantuan['desBantuan']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kuota" class="col-sm-2 col-form-label">Kuota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control border-left-primary" id="kuota" value="<?= $bantuan['kuota']; ?>" name="kuota" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Periode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control border-left-primary" id="tahun" value="<?= $bantuan['tahun']; ?>" name="tahun" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nilaiBantuan" class="col-sm-2 col-form-label">Besaran Bantuan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control border-left-primary" id="nilaiBantuan" value="<?= $bantuan['NilaiBantuan']; ?>" name="nilaiBantuan" required>
                    </div>
                </div>
                <!-- </form> -->
                <?= form_close(); ?>
            </div>
        </div>
        <!-- Syarat Program -->
        <div class="card shadow mb-4">
            <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">Syarat Program</h6>
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-2" data-toggle="modal" data-target="#addSyaratModal">
                    <i class="fa fa-plus-circle fa-sm text-white-50"></i> Tambah Syarat
                </button>
            </div>
            <div class="card-body">
                <?php if ($syaratProgram == 0) { ?>
                    <p>Belum ada syarat untuk program ini</p>
                <?php } else { ?>
                    <table class="table">
                        <thead class="bg-info text-white">
                            <tr>
                                <th class="text-center" scope="col">Syarat</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($syaratProgram as $syarat) { ?>
                                <tr>
                                    <td scope="row"><?= $syarat['Syarat']; ?></td>
                                    <td scope="row" class="text-center"><?= ($syarat['StatusSyarat'] == 'active') ? 'Aktif' : 'Tidak aktif' ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-circle" onclick="edit('<?= $syarat['idSyarat']; ?>')" title="Edit Syarat">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="hapus('<?= $syarat['idSyarat']; ?>')" class=" btn btn-danger btn-circle" title="Hapus Syarat">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="d-sm-flex align-content-center justify-content-center mb-3">
    <!-- <div class="col-12"> -->
    <a onclick="history.go(-1)" class="btn btn-md btn-secondary btn-icon-split mr-3">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-left fa-md"></i>
        </span>
        <span class="text">Kembali</span>
    </a>
    <button onclick="updateProgram()" class="btn btn-md btn-success btn-icon-split btnUpdate">
        <span class="icon text-white-50">
            <i class="fas fa-check fa-md"></i>
        </span>
        <span class="text">Simpan Perubahan</span>
    </button>
    <!-- </div> -->
</div>

<!-- Modal edit syarat -->
<div class="editSyaratModal" style="display: none"></div>

<!-- Modal Tambah Syarat -->
<div class="modal fade" id="addSyaratModal" tabindex="-1" role="dialog" aria-labelledby="addSyaratModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="addSyaratModalLabel"><strong>Tambah Syarat Program</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("/kesra/doTambahSyarat", ['class' => 'formAddSyarat']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="kodeBantuan" id="kodeBantuan" value="<?= $bantuan['kodeBantuan']; ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label style="font-weight: bold;" for="namaSyarat">Nama Syarat</label>
                    <input type="text" class="form-control border-left-primary" id="namaSyarat" name="namaSyarat" required>
                </div>
                <div class="form-group">
                    <label style="font-weight: bold;" for="stsSyarat">Status Syarat</label>
                    <select name="StatusSyarat" class="form-control border-left-primary" aria-describedby="stsHelp" id="stsSyarat" required>
                        <option value="active">Aktif</option>
                        <option value="nonactive">Tidak aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name="add" value="add" class="btn btn-primary btnSimpan">Tambahkan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min2.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
<script type="text/javascript">
    function edit(idSyarat) {
        $.ajax({
            url: "<?= site_url('kesra/frEditSyarat'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                idSyarat: idSyarat
            },
            success: function(response) {
                if (response.sukses) {
                    $('.editSyaratModal').html(response.sukses).show();
                    $('#editSyarat').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapus(idSyarat) {
        swal({
                title: "Peringatan!",
                text: "Anda yakin ingin menghapus syarat?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?= site_url('kesra/doHapusSyarat'); ?>",
                        type: "POST",
                        dataType: "json",
                        data: {
                            idSyarat: idSyarat
                        },
                        success: function(response) {
                            if (response.notallowed) {
                                swal("Tidak diizinkan!", response.notallowed, "warning")
                            } else if (response.berhasil) {
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

    function updateProgram() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: $(".formEditProgram").attr('action'),
            data: $(".formEditProgram").serialize(),
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
                        window.location = response.link;
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.formAddSyarat').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnSimpan').prop('disabled', true);
                    $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnSimpan').prop('disabled', false);
                    $('.btnSimpan').html('Tambahkan');
                },
                success: function(response) {
                    if (response.berhasil) {
                        swal("Berhasil!", response.berhasil, "success").then((value) => {
                            location.reload();
                        });
                        $('#addSyaratModal').modal('hide');
                    } else if (response.gagal) {
                        swal("Gagal!", response.gagal, "danger").then((value) => {
                            location.reload();
                        });
                        $('#addSyaratModal').modal('hide');
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