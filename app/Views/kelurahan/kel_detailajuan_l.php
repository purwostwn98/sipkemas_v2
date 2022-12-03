<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>

<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
    <div class="col-auto">
        <h1 class="h3 mb-0 text-gray-800">Detail Ajuan</h1>
    </div>
    <div class="col-auto mt-4">
        <p>Status ajuan:
            <?php if ($idStsAjuan == 1) { ?>
                <span style="border-radius: 5px;" class="bg-gray-600 p-2 text-white"><?= $StatusAjuan; ?></span>
            <?php } elseif ($idStsAjuan <= 5 && $idStsAjuan >= 2) { ?>
                <span style="border-radius: 5px;" class="bg-info p-2 text-white"><?= $StatusAjuan; ?></span>
            <?php } elseif ($idStsAjuan == 6) { ?>
                <span style="border-radius: 5px;" class="bg-warning p-2 text-white"><?= $StatusAjuan; ?></span>
            <?php } elseif ($idStsAjuan == 7) { ?>
                <span style="border-radius: 5px;" class="bg-success p-2 text-white"><?= $StatusAjuan; ?></span>
            <?php } ?>
        </p>
    </div>
</div>
<!-- Data Pemohon -->
<div class="card shadow mb-4">
    <div class="card-header bg-info py-3">
        <h6 class="m-0 font-weight-bold text-white">Data Pemohon</h6>
    </div>
    <div class="card-body">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Nomor Induk Kependudukan (NIK)</b>
                    <br>
                    <span class="text-primary">
                        <i>National Identification Number</i>
                    </span></label>
            </div>
            <div class="col-md-8">
                <?= $pemohon['NIK']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row">
            <div class="col-md-4">
                <label for="">
                    <b>Nama Lengkap</b>
                    <br>
                    <span class="text-primary">
                        <i>Full Name</i>
                    </span></label>
            </div>
            <div class="col-md-8">
                <?= $pemohon['Nama']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-4">
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
            <div class="col-md-8">
                <?= $pemohon['tempatLahir']; ?>, <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row">
            <div class="col-md-4">
                <label for="">
                    <b>Jenis Kelamin</b>
                    <br>
                    <span class="text-primary">
                        <i>Gender</i>
                    </span></label>
            </div>
            <div class="col-md-8">
                <?= ($pemohon['gender'] == 1) ? 'Laki-laki' : 'Perempuan' ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Alamat</b>
                    <br>
                    <span class="text-primary">
                        <i>Address</i>
                    </span></label>
            </div>
            <div class="col-md-8">
                <?= $pemohon['Alamat']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row">
            <div class="col-md-4">
                <label for="">
                    <b>Kelurahan</b>
                    <br>
                    <span class="text-primary">
                        <i>Sub-district</i>
                    </span></label>
            </div>
            <div class="col-md-8">
                <?= $pemohon['Kelurahan']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Kecamatan</b>
                    <br>
                    <span class="text-primary">
                        <i>Districts</i>
                    </span></label>
            </div>
            <div class="col-md-8">
                <?= $pemohon['Kecamatan']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row">
            <div class="col-md-4">
                <label for="">
                    <b>Agama</b>
                    <br>
                    <span class="text-primary">
                        <i>Religion</i>
                    </span></label>
            </div>
            <div class="col-md-8">
                <?= $pemohon['Agama']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row bg-white darker">
            <div class="col-md-4">
                <label for="">
                    <b>Telepon</b>
                    <br>
                    <span class="text-primary">
                        <i>Telephone</i>
                    </span></label>
            </div>
            <div class="col-md-8">
                <?= $pemohon['telepon']; ?>
            </div>
        </div>
        <hr class="m-0 p-1">
        <div class="row">
            <div class="col-md-4">
                <label for="">
                    Email
                    <br>
                    <span class="text-primary">
                        <i>E-mail</i>
                    </span></label>
            </div>
            <div class="col-md-8">
                <?= $pemohon['email']; ?>
            </div>
        </div>
    </div>
</div>

<!-- Data Lembaga (Jika Lembaga) -->
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

<!-- Data ajuan -->
<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between bg-info py-3">
        <h6 class="m-0 font-weight-bold text-white">Data Ajuan Bantuan</h6>
    </div>
    <?php if ($idStsAjuan != 1) { ?>
        <div class="card-body">
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
                <div class="col-md-8">
                    <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="card-body">
            Pemohon belum mengisi form ajuan
        </div>
    <?php } ?>
</div>

<!-- Dokumen pendukung -->
<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between py-3 bg-info">
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
<?php if ($idStsAjuan >= 2) { ?>
    <?php
    $tglajuan = explode('-', $ajuan['tgAjuan']);
    $tglKesra = explode('-', $ajuan['tgRecKesra']);
    $tglMitra = explode('-', $ajuan['tgRecSurvey']);
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
<?php } ?>

<!-- Keputusan Akhir -->
<?php if ($idStsAjuan >= 6) { ?>
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


<div class="row">
    <div class="col">
        <button onclick="history.go(-1)" role="button" class="btn btn-warning btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </button>
    </div>
</div>

<?= $this->endSection(); ?>