<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>
<?php
$session = \Config\Services::session();
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="col-auto">
        <h1 class="h3 mb-0 text-gray-800">Data Pemohon</h1>
        <?php if ($session->get('privUser') != 1) { ?>
            <span class="small">Pastikan pemohon sudah terdaftar E-SIK (kecuali untuk pemohon lembaga)</span>
        <?php } ?>
    </div>
</div>
<?php if ($session->getFlashdata('dontDelete')) { ?>
    <div class="row">
        <div class="col">
            <div class="alert alert-danger" role="alert" id="errorEsik">
                <?= $session->getFlashdata('dontDelete'); ?>
            </div>
        </div>
    </div>
<?php } ?>
<!-- Content Row Data Pemohon-->
<?php if ($konfirmasi == 0) { ?>
    <div class="row bg-white darker">
        <div class="col-md-6">
            <label for="">
                <b>Nomor Formulir</b>
                <br>
                <span class="text-primary">
                    <i>Form Number</i>
                </span></label>
        </div>
        <div class="col-md-6">
            <b><?= $pemohon['noFormulir']; ?></b>
        </div>
    </div>
<?php } ?>
<hr class="m-0 p-1">
<div class="row">
    <div class="col-md-6">
        <label for="">
            <b>Nomor Induk Kependudukan (NIK)</b>
            <br>
            <span class="text-primary">
                <i>National Identification Number</i>
            </span></label>
    </div>
    <div class="col-md-6">
        <?= $pemohon['NIK']; ?>
    </div>
</div>
<hr class="m-0 p-1">
<div class="row bg-white darker">
    <div class="col-md-6">
        <label for="">
            <b>Nama Lengkap</b>
            <br>
            <span class="text-primary">
                <i>Full Name</i>
            </span></label>
    </div>
    <div class="col-md-6">
        <?= $pemohon['Nama']; ?>
    </div>
</div>
<hr class="m-0 p-1">
<div class="row">
    <div class="col-md-6">
        <label for="">
            <b>Tempat, Tanggal Lahir</b>
            <br>
            <span class="text-primary">
                <i>Place, Date of Birth</i>
            </span></label>
    </div>
    <?php
    $tgl = explode('-', $pemohon['tgLahir']);
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    ?>
    <div class="col-md-6">
        <?= $pemohon['tempatLahir']; ?>, <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?>
    </div>
</div>
<hr class="m-0 p-1">
<div class="row bg-white darker">
    <div class="col-md-6">
        <label for="">
            <b>Jenis Kelamin</b>
            <br>
            <span class="text-primary">
                <i>Gender</i>
            </span></label>
    </div>
    <div class="col-md-6">
        <?= ($pemohon['gender'] == 1) ? 'Laki-laki' : 'Perempuan' ?>
    </div>
</div>
<hr class="m-0 p-1">
<div class="row">
    <div class="col-md-6">
        <label for="">
            <b>Alamat</b>
            <br>
            <span class="text-primary">
                <i>Address</i>
            </span></label>
    </div>
    <div class="col-md-6">
        <?= $pemohon['Alamat']; ?>
    </div>
</div>
<hr class="m-0 p-1">
<div class="row bg-white darker">
    <div class="col-md-6">
        <label for="">
            <b>Kelurahan</b>
            <br>
            <span class="text-primary">
                <i>Sub-district</i>
            </span></label>
    </div>
    <div class="col-md-6">
        <?= $pemohon['Kelurahan']; ?>
    </div>
</div>
<hr class="m-0 p-1">
<div class="row">
    <div class="col-md-6">
        <label for="">
            <b>Kecamatan</b>
            <br>
            <span class="text-primary">
                <i>Districts</i>
            </span></label>
    </div>
    <div class="col-md-6">
        <?= $pemohon['Kecamatan']; ?>
    </div>
</div>
<hr class="m-0 p-1">
<div class="row bg-white darker">
    <div class="col-md-6">
        <label for="">
            <b>Agama</b>
            <br>
            <span class="text-primary">
                <i>Religion</i>
            </span></label>
    </div>
    <div class="col-md-6">
        <?= $pemohon['Agama']; ?>
    </div>
</div>
<hr class="m-0 p-1">
<div class="row">
    <div class="col-md-6">
        <label for="">
            <b>Telepon</b>
            <br>
            <span class="text-primary">
                <i>Telephone</i>
            </span></label>
    </div>
    <div class="col-md-6">
        <?= $pemohon['telepon']; ?>
    </div>
</div>
<hr class="m-0 p-1">
<div class="row bg-white darker">
    <div class="col-md-6">
        <label for="">
            <b>E-mail</b>
            <br>
            <span class="text-primary">
                <i>E-mail</i>
            </span></label>
    </div>
    <div class="col-md-6">
        <?= $pemohon['email']; ?>
    </div>
</div>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
<script type="text/javascript" src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min2.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.formPengajuan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnAjukan').prop('disabled', true);
                    $('.btnAjukan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnAjukan').prop('disabled', false);
                    $('.btnAjukan').html('Ajukan Bantuan');
                },
                success: function(response) {
                    if (response.error) {
                        $('#errorEsik').css('display', "block");
                        $('#errorEsik').html(response.error.esik);
                    } else {
                        $('#errorEsik').css('display', "none");
                        $('#errorEsik').html("-");
                    }
                    if (response.berhasil) {
                        swal({
                            title: "No. Ajuan: " + response.berhasil.noAjuan,
                            text: "Ajuan berhasil didaftarkan",
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