<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ajuan</title>
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
    <table border='0' width="100%" cellpadding="0" cellspacing="0" style="border:0px solid black;margin-left:auto;margin-right:auto;">
        <tr>
            <th rowspan="4" width="80" style="text-align:center"><img width="70" src="assets/img/logo_pms.png"></th>
            <th align="center" style="text-align:center">
                <!-- <p style="font-family: times; text-align:center;"> -->
                <font size="5">PEMERINTAH KOTA SURAKARTA</font>
                <!-- </p> -->
            </th>
        </tr>
        <tr>
            <th align="center" style="text-align:center">
                <!-- <p style="font-family: times; text-align:center;"> -->
                <font size="6"><b>SEKRETARIAT DAERAH</b></font>
                <!-- </p> -->
            </th>
        </tr>
        <tr>
            <th align="center" style="text-align:center">
                <!-- <p style="font-family: times; text-align:center;"> -->
                <font size="5">BAGIAN KESEJAHTERAAN RAKYAT</font>
                <!-- </p> -->
            </th>
        </tr>
        <tr>
            <th align="center" style="text-align:center">
                <!-- <p style="font-family: times; text-align:center;"> -->
                <font size="2">Jl. Jendral Sudirman No. 2 Telp. (0271) 655398 Email: bag-kesra@surakarta.go.id <br>SURAKARTA <br>57111</font>
                <!-- </p> -->
            </th>
        </tr>
    </table>
    <div class="hr"></div>
    <h3 style="text-align: center;">Data Ajuan</h3>
    <br>
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
    <br>
    <p>
        <i>
            Simpan nomor ajuan ini. Nomor ajuan ini dapat digunakan untuk melihat proses status ajuan Anda. <br>
            Klik tombol <b>"cek ajuan"</b> pada halaman depan web SipKe-Mas kemudian masukkan nomor ajuan Anda.
        </i>
    </p>

</body>

</html>