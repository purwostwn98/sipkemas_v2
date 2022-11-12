<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .hr {
            border-bottom: double 2px #999;
            padding: 10px 0;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

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

<body>
    <table border='0' width="750" cellpadding="0" cellspacing="0" style="border:0px solid black;margin-left:auto;margin-right:auto;">
        <tr>
            <th rowspan="3" width="80" style="text-align:center"><img width="50" src="assets/img/logo_pms.png"></th>
            <th style="text-align:left">
                <p style="font-family: times">
                    <font size="6">Sekretariat Daerah Bagian Kesejahteraan Rakyat</font>
                </p>
            </th>
        </tr>
        <tr>
            <th style="text-align:left">
                <p style="font-family: times">
                    <font size="4"><b>Pemerintah Kota Surakarta</b></font>
                </p>
            </th>
        </tr>
        <tr>
            <th style="text-align:left">
                <p style="font-family: times">
                    <font size="2">Komp. Balai Kota, JL. Jend. Sudirman, No. 2Kp. Baru, Kec. Ps. Kliwon Kota Surakarta, Jawa Tengah 57133</font>
                </p>
            </th>
        </tr>
    </table>
    <div class="hr"></div>
    <?php
    $t = explode('-', $tglNow);
    $a = explode(' ', $t[2]);
    $tglSekarang = $a[0] . ' ' . $bulan[(int)$t[1]] . ' ' . $t[0];
    ?>
    <div align="right" style="margin-right: 20px;">Surakarta, <?= $tglSekarang; ?></div>
    <h3 align='center'>Resume Ajuan</h3>
    <strong>Data Pemohon</strong>
    <table style="width: 100%; text-align:left; vertical-align:top;">
        <tr align="left">
            <td style="width: 40%; text-align:left;">No. Ajuan</td>
            <td style="width: 3%;">:</td>
            <td style="text-align: left;"><?= $ajuan['noAjuan']; ?></td>
        </tr>
        <tr align="left">
            <td style="width: 40%; text-align:left;">Nama</td>
            <td style="width: 3%;">:</td>
            <td style="text-align: left;"><?= $ajuan['Nama']; ?></td>
        </tr>
        <tr align="left">
            <td style="width: 40%; text-align:left;">NIK</td>
            <td style="width: 3%;">:</td>
            <td style="text-align: left;"><?= $ajuan['NIK']; ?></td>
        </tr>
        <tr>
            <td style="width: 40%; text-align:left;">Alamat</td>
            <td style="width: 3%">:</td>
            <td style="text-align:left;">
                <?= $ajuan['Alamat']; ?>,<br>
                <?= $ajuan['Kelurahan']; ?>, <?= $ajuan['Kecamatan']; ?>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; text-align:left;">No Tlp.</td>
            <td style="width: 3%">:</td>
            <td style="text-align: left;"><?= $ajuan['telepon']; ?></td>
        </tr>
    </table>
    <br>
    <strong>Data Ajuan</strong>
    <table style="width: 100%; text-align:left; vertical-align:top;">
        <tr align="left">
            <td style="width: 40%; text-align:left;">Program Bantuan</td>
            <td style="width: 3%;">:</td>
            <td style="text-align: left;"><?= $ajuan['NamaMitra']; ?>: <?= $ajuan['namaProgram']; ?></td>
        </tr>
        <tr align="left">
            <td style="width: 40%; text-align:left;">Deskripsi Bantuan</td>
            <td style="width: 3%;">:</td>
            <td style="text-align: left;"><?= $ajuan['Keperluan']; ?></td>
        </tr>
        <tr align="left">
            <td style="width: 40%; text-align:left;">Nilai yang Diajukan</td>
            <td style="width: 3%;">:</td>
            <td style="text-align: left;"> Rp <?= number_format((float)$ajuan['Kebutuhan'], 0, ',', '.'); ?></td>
        </tr>
        <tr align="left">
            <td style="width: 40%; text-align:left;">Tanggal Pengajuan</td>
            <td style="width: 3%;">:</td>
            <td style="text-align: left;">
                <?php $tgl = explode('-', $ajuan['tgAjuan']); ?>
                <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?>
            </td>
        </tr>
        <tr align="left">
            <td style="width: 40%; text-align:left;">Jenis Ajuan</td>
            <td style="width: 3%;">:</td>
            <td style="text-align: left;"><?= ($ajuan['idJnsAjuan'] == 0) ? 'Individu' : 'Lembaga' ?></td>
        </tr>
    </table>
    <br>
    <?php if ($ajuan['idJnsAjuan'] != 0) { ?>
        <strong>Data Lembaga</strong>
        <table style="width: 100%; text-align:left; vertical-align:top;">
            <tr align="left">
                <td style="width: 40%; text-align:left;">Nama Lembaga</td>
                <td style="width: 3%;">:</td>
                <td style="text-align: left;"><?= $lembaga['namaLembaga']; ?></td>
            </tr>
            <tr align="left">
                <td style="width: 40%; text-align:left;">Alamat Lembaga</td>
                <td style="width: 3%;">:</td>
                <td style="text-align: left;"><?= $lembaga['alamat']; ?></td>
            </tr>
            <tr align="left">
                <td style="width: 40%; text-align:left;">No. Lembaga</td>
                <td style="width: 3%;">:</td>
                <td style="text-align: left;">
                    <?= $lembaga['Akta']; ?>
                </td>
            </tr>
            <tr align="left">
                <td style="width: 40%; text-align:left;">Jenis Ajuan</td>
                <td style="width: 3%;">:</td>
                <td style="text-align: left;"><?= ($ajuan['idJnsAjuan'] == 0) ? 'Individu' : 'Lembaga' ?></td>
            </tr>
        </table>
        <br>
    <?php } ?>
    <?php
    $tglajuan = explode('-', $ajuan['tgAjuan']);
    ?>
    <strong>Status Ajuan</strong>
    <table style="width: 100%; text-align:left; vertical-align:top;">
        <tr align="left">
            <td style="width: 40%; text-align:left;">Pengajuan Bantuan</td>
            <td style="width: 3%;">:</td>
            <td style="text-align: left;">
                <?php if ($ajuan['idStsAjuan'] >= 1) { ?>
                    <span class="<?= ($ajuan['idStsAjuan'] >= 1) ? 'bg-success' : '' ?> text-white p-1">
                        <?= $tglajuan[2] . ' ' . $bulan[(int)$tglajuan[1]] . ' ' . $tglajuan[0]; ?>
                    </span>
                <?php } ?>
            </td>
        </tr>
        <tr align="left">
            <td style="width: 40%; text-align:left;">Proses Kesra</td>
            <td style="width: 3%;">:</td>
            <td style="text-align: left;">
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
            </td>
        </tr>
        <tr>
            <td style="width: 40%; text-align:left;">Proses Mitra</td>
            <td style="width: 3%">:</td>
            <td style="text-align:left;">
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
            </td>
        </tr>
        <tr>
            <td style="width: 40%; text-align:left;">Hasil</td>
            <td style="width: 3%">:</td>
            <td style="text-align:left;">
                <?php if ($ajuan['idStsAjuan'] == 6) { ?>
                    <span class="bg-danger text-white p-1">Ditolak</span>
                <?php } elseif ($ajuan['idStsAjuan'] == 7) {
                    echo "<span class='bg-success text-white p-1'>Disetujui</span>";
                } else {
                    echo "<span class='bg-secondary text-white p-1'>Belum diproses</span>";
                } ?>
            </td>
        </tr>
    </table>
    <br>
    <?php if ($ajuan['idStsAjuan'] >= 6) { ?>
        <strong>Hasil Keputusan Forum Kesra</strong>
        <table style="width: 100%; text-align:left; vertical-align:top;">
            <tr align="left">
                <td style="width: 40%; text-align:left;">Status</td>
                <td style="width: 3%;">:</td>
                <td style="text-align: left;"><strong><?= $ajuan['StatusAjuan']; ?></strong></td>
            </tr>
            <tr align="left">
                <td style="width: 40%; text-align:left;">Alasan/catatan</td>
                <td style="width: 3%;">:</td>
                <td style="text-align: left;"><?= $ajuan['ketRecSurvey']; ?></td>
            </tr>
            <tr>
                <td style="width: 40%; text-align:left;">Nilai yang Disetujui</td>
                <td style="width: 3%">:</td>
                <td style="text-align:left;">
                    Rp. <?= number_format((float)$ajuan['nilaiDisetujui'], 0, ',', '.'); ?>
                </td>
            </tr>
        </table>
    <?php } ?>
</body>

</html>