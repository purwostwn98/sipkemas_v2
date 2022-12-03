<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>
<?php
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
<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
    <div class="col-auto">
        <h1 class="h3 mb-0 text-gray-800">Detail Ajuan</h1>
    </div>
    <div class="col-auto mt-4">
        <p>Status ajuan:
            <?php if ($ajuan['idStsAjuan'] <= 4) { ?>
                <span style="border-radius: 5px;" class="bg-info p-2 text-white"><?= $ajuan['StatusAjuan']; ?></span>
            <?php } elseif ($ajuan['idStsAjuan'] == 5) { ?>
                <span style="border-radius: 5px;" class="bg-primary p-2 text-white"><?= $ajuan['StatusAjuan']; ?></span>
            <?php } elseif ($ajuan['idStsAjuan'] == 6) { ?>
                <span style="border-radius: 5px;" class="bg-danger p-2 text-white"><?= $ajuan['StatusAjuan']; ?></span>
            <?php } elseif ($ajuan['idStsAjuan'] == 7) { ?>
                <span style="border-radius: 5px;" class="bg-success p-2 text-white"><?= $ajuan['StatusAjuan']; ?></span>
            <?php } ?>
        </p>
    </div>
</div>

<!-- Data Ajaun -->
<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between bg-info py-3">
        <h6 class="m-0 font-weight-bold text-white">Data Ajuan Bantuan</h6>
    </div>
    <div class="card-body">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Jenis Bantuan</b>
                </label>
            </div>
            <div class="col-md-8">
                <?= ($ajuan['idJnsAjuan'] == 0) ? 'Individu' : 'Lembaga' ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Program Bantuan</b>
                </label>
            </div>
            <div class="col-md-8">
                <?= $ajuan['NamaMitra']; ?>: <?= $ajuan['namaProgram']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Nilai Bantuan</b>
                </label>
            </div>
            <div class="col-md-8">
                Rp <?= number_format((float)$ajuan['Kebutuhan'], 0, ',', '.'); ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Deskripsi Bantuan</b>
                </label>
            </div>
            <div class="col-md-8">
                <?= $ajuan['Keperluan']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Tgl. Ajuan</b>
                </label>
            </div>
            <?php
            $tgl = explode('-', $ajuan['tgAjuan']);
            ?>
            <div class="col-md-8">
                <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?>
            </div>
        </div>
        <!-- <?php if ($ajuan['idJnsAjuan'] == 0) { ?>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Status E-SIK</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= ($ajuan['eSik'] == 0) ? 'Tidak Terdaftar' : 'Terdaftar' ?>
                </div>
            </div>
        <?php } ?> -->
        <?php if ($ajuan['eSik'] == 0 && $ajuan['idJnsAjuan'] == 0) { ?>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Surat Keterangan Pemohon</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <a href="<?= base_url(); ?>/uploads_syarat/<?= $ajuan['srtKetPemohon']; ?>" class="btn btn-success btn-sm btn-icon-split mb-2" target="_blank">
                        <span class="icon text-white-50"> <i class="fas fa-check"></i></span><span class="text">Lihat</span>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Data Lembaga (Jika Lembaga) -->
<?php if ($ajuan['idJnsAjuan'] != 0) { ?>
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between bg-info py-3">
            <h6 class="m-0 font-weight-bold text-white">Data Lembaga</h6>
        </div>
        <div class="card-body">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Nama Lembaga</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $lembaga['namaLembaga']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Alamat Lembaga</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $lembaga['alamat']; ?>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>No. Lembaga</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $lembaga['Akta']; ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Dokumen Syarat -->
<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between bg-info py-3">
        <h6 class="m-0 font-weight-bold text-white">Dokumen Pendukung</h6>
    </div>
    <div class="card-body">
        <?php foreach ($dokumen as $dok) { ?>
            <div class="row bg-white darker">
                <div class="col-md-6">
                    <label for="">
                        <b><?php echo $dok['Syarat'] ?></b>
                    </label>
                </div>
                <div class="col-md-6">
                    <a href="<?= base_url(); ?>/uploads_syarat/<?= $dok['namaFile']; ?>" class="btn btn-success btn-sm btn-icon-split mb-2" target="_blank">
                        <span class="icon text-white-50"> <i class="fas fa-check"></i></span><span class="text">Lihat</span>
                    </a>
                </div>
            </div>
            <hr class="m-0 p-1">
        <?php } ?>
    </div>
</div>

<!-- Status Ajuan -->
<?php
$tglajuan = explode('-', $ajuan['tgAjuan']);
?>
<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between bg-info py-3">
        <h6 class="m-0 font-weight-bold text-white">Status Ajuan</h6>
    </div>
    <div class="card-body">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Pengajuan Bantuan</b>
                </label>
            </div>
            <div class="col-md-8">
                <?php if ($ajuan['idStsAjuan'] >= 1) { ?>
                    <span class="<?= ($ajuan['idStsAjuan'] >= 1) ? 'bg-success' : '' ?> text-white p-1">
                        <?= $tglajuan[2] . ' ' . $bulan[(int)$tglajuan[1]] . ' ' . $tglajuan[0]; ?>
                    </span>
                <?php } ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Proses Kesra</b>
                </label>
            </div>
            <div class="col-md-8">
                <?php if ($ajuan['idStsAjuan'] >= 4) { ?>
                    <?php $tglKesra = explode('-', $ajuan['tgRecKesra']); ?>
                    <span class="bg-success text-white p-1">
                        <?= $tglKesra[2] . ' ' . $bulan[(int)$tglKesra[1]] . ' ' . $tglKesra[0]; ?>
                    </span>
                <?php } elseif ($ajuan['idStsAjuan'] == 3) {
                    echo "<span class='bg-warning text-white p-1'>Sedang diproses</span>";
                } else {
                    echo "<span class='bg-secondary text-white p-1'>Belum diproses</span>";
                } ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Proses Mitra</b>
                </label>
            </div>
            <div class="col-md-8">
                <?php if ($ajuan['idStsAjuan'] >= 6) { ?>
                    <?php $tglMitra = explode('-', $ajuan['tgRecSurvey']); ?>
                    <span class="bg-success text-white p-1">
                        <?= $tglMitra[2] . ' ' . $bulan[(int)$tglMitra[1]] . ' ' . $tglMitra[0]; ?>
                    </span>
                <?php } elseif ($ajuan['idStsAjuan'] == 4) {
                    echo "<span class='bg-warning text-white p-1'>Sedang diproses</span>";
                } elseif ($ajuan['idStsAjuan'] == 5) {
                    echo "<span class='bg-primary text-white p-1'>Survey</span>";
                } else {
                    echo "<span class='bg-secondary text-white p-1'>Belum diproses</span>";
                } ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Hasil</b>
                </label>
            </div>
            <div class="col-md-8">
                <?php if ($ajuan['idStsAjuan'] == 6) { ?>
                    <span class="bg-danger text-white p-1">Ditolak</span>
                <?php } elseif ($ajuan['idStsAjuan'] == 7) {
                    echo "<span class='bg-success text-white p-1'>Disetujui</span>";
                } else {
                    echo "<span class='bg-secondary text-white p-1'>Belum diproses</span>";
                } ?>
            </div>
        </div>

    </div>
</div>

<!-- Keputusan Akhir -->
<?php if ($ajuan['idStsAjuan'] >= 6) { ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 <?= ($ajuan['idStsAjuan'] == 6) ? 'bg-danger' : 'bg-success' ?>">
            <h6 class="m-0 font-weight-bold text-white">Hasil Keputusan Forum Kesra</h6>
        </div>
        <div class="card-body">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Status</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <span style="border-radius: 5px;" class="text-white <?= ($ajuan['idStsAjuan'] == 6) ? 'bg-danger' : 'bg-success' ?> p-1">
                        <?= $ajuan['StatusAjuan']; ?>
                    </span>
                </div>
            </div>
            <hr class="m-0 p-1">
            <div class="row bg-white darker">
                <div class="col-md-4">
                    <label for="">
                        <b>Alasan / catatan</b>
                    </label>
                </div>
                <div class="col-md-8">
                    <?= $ajuan['ketRecSurvey']; ?>
                </div>
            </div>
            <?php if ($ajuan['idStsAjuan'] == 7) { ?>
                <hr class="m-0 p-1">
                <div class="row bg-white darker">
                    <div class="col-md-4">
                        <label for="">
                            <b>Nilai bantuan disetujui</b>
                        </label>
                    </div>
                    <div class="col-md-8">
                        Rp. <?= number_format((float)$ajuan['nilaiDisetujui'], 0, ',', '.'); ?>
                    </div>
                </div>
                <hr class="m-0 p-1">
                <div class="row bg-white darker">
                    <div class="col-md-4">
                        <label for="">
                            <b>Bentuk Penyerahan</b>
                        </label>
                    </div>
                    <div class="col-md-8">
                        <?= $ajuan['bentukPenyerahan']; ?>
                    </div>
                </div>
                <?php if ($ajuan['tgPenyerahan'] != '') { ?>
                    <hr class="m-0 p-1">
                    <div class="row bg-white darker">
                        <div class="col-md-4">
                            <label for="">
                                <b>Tgl Penyerahan</b>
                            </label>
                        </div>
                        <div class="col-md-8">
                            <?php $tgPenyerahan = explode('-', $ajuan['tgPenyerahan']); ?>
                            <span class="bg-info text-white p-1">
                                <?= $tgPenyerahan[2] . ' ' . $bulan[(int)$tgPenyerahan[1]] . ' ' . $tgPenyerahan[0]; ?>
                            </span>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php } ?>


<div class="row mb-2">
    <div class="col text-center">
        <a href="/pemohon/cetakResume" class="btn btn-danger btn-icon-split">
            <span class="icon text-white-50">
                <i class="fa fa-file-pdf"></i>
            </span>
            <span class="text">Cetak Resume</span>
        </a>
    </div>
</div>



<?= $this->endSection(); ?>