<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Formulir Pendaftaran</h1>
</div>

<div id="accordion" class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
        <div>
            <a class="d-none d-sm-inline-block btn btn-sm btn-success" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                Pemohon Terdaftar
            </a>
        </div>
        <!-- <a href="/pemohon/frpemohon" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-edit fa-sm text-white-50"></i> Tambah Pemohon</a> -->
    </div>

    <!-- Tabel Pemohon Terdaftar -->
    <div class="collapse show" id="collapseExample2" data-parent="#accordion">
        <div style="font-size: 12px;" class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable2" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr class="text-center" role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 15px;">No</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 45px;">NIK</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 62px;">Nama</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Tgl. Ajuan: activate to sort column ascending" style="width: 70px;">Alamat</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Jenis Bantuan: activate to sort column ascending" style="width: 30px;">Jenis Kelamin</th>
                                        <th aria-controls="dataTable2" rowspan="1" colspan="1" style="width: 5px;">Aksi</th>
                                        <!-- <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 25px;">Riwayat Ajuan</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no2 = 0;
                                    foreach ($pemohon_terdaftar as $pemohon) : ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1 text-center"><?= $no2 + 1; ?></td>
                                            <td><?= $pemohon['NIK']; ?></td>
                                            <td><?= $pemohon['Nama']; ?></td>
                                            <td><?= $pemohon['Alamat']; ?></td>
                                            <td><?= ($pemohon['gender'] == 1) ? 'Laki-laki' : 'Perempuan' ?></td>
                                            <td>
                                                <a href="/kelurahan/dtpemohon?konfirmasi=<?= md5(1); ?>&idPemohon=<?= $pemohon['idPemohon']; ?>" class="btn btn-info btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                    <span class="text">Lihat Detail</span>
                                                </a>
                                            </td>
                                            <!-- <td class="text-center">0</td> -->
                                        </tr>
                                    <?php $no2++;
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



<?= $this->endSection(); ?>