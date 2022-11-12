<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>
<?php
$session = \Config\Services::session();
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Program</h1>
</div>
<div class="row">
    <div class="col-lg-12">
        <!-- Data Program -->
        <?= form_open("/kesra/doTambahProgram", ['class' => 'formTambahProgram']); ?>
        <?= csrf_field(); ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Program</h6>
            </div>
            <div class="card-body">
                <!-- <form> -->
                <div class="form-group row">
                    <label for="idMitra" class="col-sm-2 col-form-label">Pilih Mitra</label>
                    <div class="col-sm-10">
                        <select id="idMitra" name="idMitra" class="form-control border-left-primary" onchange="getMitra(this)" required>
                            <option value="" selected disabled>--Pilih Mitra--</option>
                            <?php if ($session->get('privUser') == 4) { ?>
                                <?php foreach ($mitra as $mit) { ?>
                                    <option value="<?= $mit['idMitra']; ?>"><?= $mit['NamaMitra']; ?></option>
                                <?php } ?>
                            <?php } else { ?>
                                <?php foreach ($mitra2 as $mit) { ?>
                                    <option value="<?= $mit['idMitra']; ?>"><?= $mit['NamaMitra']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kodeBantuan" class="col-sm-2 col-form-label">Kode Bantuan</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control border-left-warning" id="kodeBantuan" name="kodeBantuan" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stsProgram" class="col-sm-2 col-form-label">Status Program</label>
                    <div class="col-sm-10">
                        <select name="StatusProgram" class="form-control border-left-primary" required>
                            <option value="active">Aktif</option>
                            <option value="nonactive">Tidak aktif</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namaProgram" class="col-sm-2 col-form-label">Nama Program</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control border-left-primary" id="namaProgram" name="namaProgram" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desProgram" class="col-sm-2 col-form-label">Deskripsi Program</label>
                    <div class="col-sm-10">
                        <textarea class="form-control border-left-primary" id="desProgram" name="desBantuan" rows="4" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kuota" class="col-sm-2 col-form-label">Kuota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control border-left-primary" id="kuota" name="kuota" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Periode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control border-left-primary" id="tahun" name="tahun" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nilaiBantuan" class="col-sm-2 col-form-label">Besaran Bantuan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control border-left-primary" id="nilaiBantuan" name="nilaiBantuan" required>
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
        <!-- Syarat Program -->
        <div class="card shadow mb-4">
            <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">Syarat Program</h6>
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-2 btnAddRow">
                    <i class="fa fa-plus-circle fa-sm text-white-50"></i> Tambah Baris
                </button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="bg-info text-white">
                        <tr>
                            <th class="text-center" scope="col">Nama Syarat</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="formSyarat">
                        <tr>
                            <td>
                                <input type="text" name="Syarat[]" id="namaSyarat" class="form-control border-left-primary" placeholder="Nama Syarat" required>
                            </td>
                            <td>
                                <select name="StatusSyarat[]" class="form-control border-left-primary" aria-describedby="stsHelp" id="stsSyarat" required>
                                    <option value="active">Aktif</option>
                                    <option value="nonactive">Tidak aktif</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary btn-circle">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?= form_close(); ?>
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
    <button onclick="simpanProgram()" class="btn btn-md btn-success btn-icon-split btnSave">
        <span class="icon text-white-50">
            <i class="fas fa-check fa-md"></i>
        </span>
        <span class="text">Simpan</span>
    </button>
    <!-- </div> -->
</div>

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
<script type="text/javascript" src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min2.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btnAddRow').click(function(e) {
            e.preventDefault();
            $('.formSyarat').append(`
            <tr>
                <td>
                    <input type="text" name="Syarat[]" id="namaSyarat" class="form-control border-left-primary" placeholder="Nama Syarat" required>
                </td>
                <td>
                    <select name="StatusSyarat[]" class="form-control border-left-primary" aria-describedby="stsHelp" id="stsSyarat">
                        <option value="active">Aktif</option>
                        <option value="nonactive">Tidak aktif</option>
                    </select>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-circle btnhapusbaris" id="btnhapusbaris">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            `);
        });

        $(document).on('click', '.btnhapusbaris', function(e) {
            e.preventDefault();

            $(this).parents('tr').remove();
        });
    });

    function getMitra(idMitra) {
        var idMitra = idMitra.value;
        $.ajax({
            url: "<?= site_url('kesra/createKodeBantuan'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                idMitra: idMitra
            },
            success: function(response) {
                if (response.sukses) {
                    $("#kodeBantuan").val(response.sukses.kodeMitra + "-" + response.sukses.kodeAngka);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<script type="text/javascript">
    function simpanProgram() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: $(".formTambahProgram").attr('action'),
            data: $(".formTambahProgram").serialize(),
            beforeSend: function() {
                $('.btnSave').prop('disabled', true);
                $('.btnSave').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btnSave').prop('disabled', false);
                $('.btnSave').html("<span class='icon text-white-50'><i class='fas fa-check fa-md'></i></span><span class='text'>Simpan</span>");
            },
            success: function(response) {
                if (response.sukses) {
                    swal("Berhasil!", response.sukses.pesan, "success").then((value) => {
                        window.location = response.sukses.link;
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



<?= $this->endSection(); ?>