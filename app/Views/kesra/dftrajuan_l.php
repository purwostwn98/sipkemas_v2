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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Ajuan Lembaga</h1>
</div>

<div id="accordion" class="card shadow mb-4">
    <div class="card-header py-3">
        <div>
            <a class="btn btn-sm btn-warning" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
                Permintaan Rekomendasi
            </a>
            <a class="btn btn-sm btn-primary" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                Ajuan Dalam Proses
            </a>
            <a class="btn btn-sm btn-success" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                Ajuan Selesai
            </a>
        </div>
    </div>
    <!-- Permintaan Rekomendasi -->
    <div class="collapse show" id="collapseExample1" data-parent="#accordion">
        <div style="font-size: 12px;" class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row" class="text-center">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 5px;">No</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 45px;">No Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 45px;">NIK Pemohon</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 50px;">Pemohon</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 60px;">Nama Lembaga</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Jenis Bantuan: activate to sort column ascending" style="width: 30px;">Program Bantuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Tgl. Ajuan: activate to sort column ascending" style="width: 40px;">Tgl. Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Status Ajuan: activate to sort column ascending" style="width: 30px;">Status Ajuan</th>
                                        <th aria-controls="dataTable" rowspan="1" colspan="1" style="width: 7px;">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($ajuan_baru as $baru) { ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1"><?= $no; ?></td>
                                            <td><?= $baru['noAjuan']; ?></td>
                                            <td><?= $baru['NIK']; ?></td>
                                            <td><?= $baru['Nama']; ?></td>
                                            <td><?= $baru['namaLembaga']; ?></td>
                                            <td><?= $baru['NamaMitra']; ?>: <?= $baru['namaProgram']; ?></td>
                                            <?php
                                            $blnthn = explode('-', $baru['tgAjuan']);
                                            ?>
                                            <td><?= $blnthn[2] . ' ' . $bulan[(int)$blnthn[1]] . ' ' . $blnthn[0]; ?></td>
                                            <td>
                                                <span style="border-radius: 5px;" <?php if ($baru['idStsAjuan'] == 1) {
                                                                                        echo ("class='small text-white bg-gray-600 p-1'");
                                                                                    } elseif ($baru['idStsAjuan'] == 2) {
                                                                                        echo ("class='small text-white bg-info p-1'");
                                                                                    } elseif ($baru['idStsAjuan'] == 3) {
                                                                                        echo ("class='small text-white bg-gray-600 p-1'");
                                                                                    } ?>>
                                                    To Recomendation
                                                </span>
                                            </td>
                                            <td>
                                                <a href="/kesra/detailajuan_l/<?= $baru['noAjuan']; ?>" class="btn btn-info btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-search"></i>
                                                    </span>
                                                    <span class="text">Isi Rekomendasi</span>
                                                </a>
                                                <input type="hidden" class="csrf_input" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                <button type="button" role="button" id="btnHapus" onclick="hapus('<?= $baru['noAjuan']; ?>')" class="btn btn-danger btn-icon-split btn-sm">
                                                    <span class="icon text-white">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabel Ajuan Dalam Proses -->
    <div class="collapse" id="collapseExample2" data-parent="#accordion">
        <div style="font-size: 12px;" class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable1" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row" class="text-center">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 5px;">No</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 45px;">No Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 45px;">NIK Pemohon</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 50px;">Pemohon</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 60px;">Nama Lembaga</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Jenis Bantuan: activate to sort column ascending" style="width: 30px;">Program Bantuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Tgl. Ajuan: activate to sort column ascending" style="width: 40px;">Tgl. Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Tgl. Ajuan: activate to sort column ascending" style="width: 55px;">Rek.Kesra</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Status Ajuan: activate to sort column ascending" style="width: 30px;">Status Ajuan</th>
                                        <th aria-controls="dataTable1" rowspan="1" colspan="1" style="width: 7px;">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no1 = 1;
                                    foreach ($ajuan_proses as $proses) { ?>
                                        <tr role="row" class="odd">

                                            <td class="sorting_1"><?= $no1; ?></td>
                                            <td><?= $proses['noAjuan']; ?></td>
                                            <td><?= $proses['NIK']; ?></td>
                                            <td><?= $proses['Nama']; ?></td>
                                            <td><?= $proses['namaLembaga']; ?></td>
                                            <td><?= $proses['NamaMitra']; ?>: <?= $proses['namaProgram']; ?></td>
                                            <?php
                                            $blnthn = explode('-', $proses['tgAjuan']);
                                            ?>
                                            <td><?= $blnthn[2] . ' ' . $bulan[(int)$blnthn[1]] . ' ' . $blnthn[0]; ?></td>
                                            <td class="text-center">
                                                <?php if ($proses['idStsAjuan'] == 2) { ?>
                                                    -
                                                <?php } else { ?>
                                                    <span class="fa fa-star <?= ($proses['idRecKesra'] >= 1) ? 'oke' : '' ?>"></span>
                                                    <span class="fa fa-star <?= ($proses['idRecKesra'] >= 2) ? 'oke' : '' ?>"></span>
                                                    <span class="fa fa-star <?= ($proses['idRecKesra'] >= 3) ? 'oke' : '' ?>"></span>
                                                    <span class="fa fa-star <?= ($proses['idRecKesra'] >= 4) ? 'oke' : '' ?>"></span>
                                                    <span class="fa fa-star <?= ($proses['idRecKesra'] == 5) ? 'oke' : '' ?>"></span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <span style="border-radius: 5px;" <?php if ($proses['idStsAjuan'] == 1) {
                                                                                        echo ("class='small text-white bg-gray-600 p-1'");
                                                                                    } elseif ($proses['idStsAjuan'] == 2) {
                                                                                        echo ("class='small text-white bg-info p-1'");
                                                                                    } elseif ($proses['idStsAjuan'] == 3) {
                                                                                        echo ("class='small text-white bg-warning p-1'");
                                                                                    } elseif ($proses['idStsAjuan'] == 4) {
                                                                                        echo ("class='small text-white bg-primary p-1'");
                                                                                    } elseif ($proses['idStsAjuan'] == 5) {
                                                                                        echo ("class='small text-white bg-primary p-1'");
                                                                                    }  ?>>
                                                    <?= $proses['StatusAjuan']; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="/kesra/detailajuan_l/<?= $proses['noAjuan']; ?>" class="btn btn-info btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-search"></i>
                                                    </span>
                                                    <span class="text">Detail</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php $no1++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabel Ajuan Selesai -->
    <div class="collapse" id="collapseExample3" data-parent="#accordion">
        <div style="font-size: 12px;" class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable2" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row" class="text-center">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 5px;">No</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 45px;">No Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 45px;">NIK Pemohon</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 50px;">Pemohon</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 60px;">Nama Lembaga</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Jenis Bantuan: activate to sort column ascending" style="width: 30px;">Program Bantuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Tgl. Ajuan: activate to sort column ascending" style="width: 40px;">Tgl. Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Tgl. Ajuan: activate to sort column ascending" style="width: 55px;">Rek.Kesra</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Status Ajuan: activate to sort column ascending" style="width: 30px;">Status Ajuan</th>
                                        <th aria-controls="dataTable2" rowspan="1" colspan="1" style="width: 7px;">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no2 = 1;
                                    foreach ($ajuan_selesai as $selesai) { ?>
                                        <tr role="row" class="odd">

                                            <td class="sorting_1"><?= $no2; ?></td>
                                            <td><?= $selesai['noAjuan']; ?></td>
                                            <td><?= $selesai['NIK']; ?></td>
                                            <td><?= $selesai['Nama']; ?></td>
                                            <td><?= $selesai['namaLembaga']; ?></td>
                                            <td><?= $selesai['NamaMitra']; ?>: <?= $selesai['namaProgram']; ?></td>
                                            <?php
                                            $blnthn = explode('-', $selesai['tgAjuan']);
                                            ?>
                                            <td><?= $blnthn[2] . ' ' . $bulan[(int)$blnthn[1]] . ' ' . $blnthn[0]; ?></td>
                                            <td class="text-center">
                                                <?php if ($selesai['idStsAjuan'] == 2) { ?>
                                                    -
                                                <?php } else { ?>
                                                    <span class="fa fa-star <?= ($selesai['idRecKesra'] >= 1) ? 'oke' : '' ?>"></span>
                                                    <span class="fa fa-star <?= ($selesai['idRecKesra'] >= 2) ? 'oke' : '' ?>"></span>
                                                    <span class="fa fa-star <?= ($selesai['idRecKesra'] >= 3) ? 'oke' : '' ?>"></span>
                                                    <span class="fa fa-star <?= ($selesai['idRecKesra'] >= 4) ? 'oke' : '' ?>"></span>
                                                    <span class="fa fa-star <?= ($selesai['idRecKesra'] == 5) ? 'oke' : '' ?>"></span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <span style="border-radius: 5px;" <?php if ($selesai['idStsAjuan'] == 6) {
                                                                                        echo ("class='small text-white bg-danger p-1'");
                                                                                    } elseif ($selesai['idStsAjuan'] == 7) {
                                                                                        echo ("class='small text-white bg-success p-1'");
                                                                                    } ?>>
                                                    <?= $selesai['StatusAjuan']; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="/kesra/detailajuan_l/<?= $selesai['noAjuan']; ?>" class="btn btn-info btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-search"></i>
                                                    </span>
                                                    <span class="text">Detail</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php $no2++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    function hapus(no_ajuan) {
        var csrfName = $('.csrf_input').attr('name'); // CSRF Token name
        var csrfHash = $('.csrf_input').val(); // CSRF hash
        swal({
                title: "Anda yakin?",
                text: "Anda ingin menghapus ajuan " + no_ajuan,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?= site_url('kesra/hapus_ajuan'); ?>",
                        type: "POST",
                        dataType: "json",
                        data: {
                            no_ajuan: no_ajuan,
                            [csrfName]: csrfHash
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('#btnHapus').prop('disabled', true);
                            $('#btnHapus').html('<i class="fa fa-spin fa-spinner"></i>');
                        },
                        complete: function() {
                            $('#btnHapus').prop('disabled', false);
                            $('#btnHapus').html('<span class="icon text-white"><i class="fas fa-trash"></i></span>');
                        },
                        success: function(response) {
                            if (response.gagal) {
                                if (response.gagal.pesan) {
                                    swal("Mohon Maaf!", response.gagal.pesan, "error");
                                }
                                // $("input[name='csrf_test_name']").val(response.error.token);
                            }
                            if (response.berhasil) {
                                swal({
                                    title: "Sukses",
                                    text: response.berhasil.pesan,
                                    icon: "success",
                                    button: "Ok",
                                }).then((value) => {
                                    location.reload();
                                });
                            }
                            // Update CSRF hash
                            $('.txt_csrfname').val(response.token);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                            // Update CSRF hash
                            $('.txt_csrfname').val(response.token);
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