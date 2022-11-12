<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Ajuan Individu</h1>
</div>

<div id="accordion" class="card shadow">
    <div class="card-header">
        <div>
            <a class="btn btn-sm btn-secondary" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
                Belum Upload Syarat
            </a>
            <a class="btn btn-sm btn-warning" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                Ajuan Dalam Proses
            </a>
            <a class="btn btn-sm btn-success" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                Ajuan Selesai
            </a>
        </div>
    </div>
    <!-- Ajuan Belum Upload -->
    <div class="collapse show" id="collapseExample1" data-parent="#accordion">
        <div style="font-size: 12px;" class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row text-center">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 7px;">No</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 45px;">No.Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 50px;">NIK</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 50px;">Nama</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Tgl. Ajuan: activate to sort column ascending" style="width: 40px;">Tgl. Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Status Ajuan: activate to sort column ascending" style="width: 40px;">Status Ajuan</th>
										<th aria-controls="dataTable" rowspan="1" colspan="1" style="width: 10px;">Aksi</th>
                                        
									</tr>
                                </thead>
                                <tbody>
                                    <?php $no1 = 0;
                                    foreach ($ajuan_baru as $proses) : ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1 text-center"><?= $no1 + 1; ?></td>
                                            <td><?= $proses['noAjuan']; ?></td>
                                            <td><?= $proses['NIK']; ?></td>
                                            <td><?= $proses['Nama']; ?></td>
                                            <?php
                                            $blnthn = explode('-', $proses['tgAjuan']);
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
                                            <td><?= $blnthn[2] . ' ' . $bulan[(int)$blnthn[1]] . ' ' . $blnthn[0]; ?></td>
                                            <td>
                                                <span style="border-radius: 5px;" <?php if ($proses['idStsAjuan'] == 1) {
                                                                                        echo ("class='small text-white bg-gray-600 p-1'");
                                                                                    } elseif ($proses['idStsAjuan'] == 2) {
                                                                                        echo ("class='small text-white bg-info p-1'");
                                                                                    } elseif ($proses['idStsAjuan'] == 3) {
                                                                                        echo ("class='small text-white bg-warning p-1'");
                                                                                    } elseif ($proses['idStsAjuan'] == 4) {
                                                                                        echo ("class='small text-white bg-dark p-1'");
                                                                                    } ?>>
                                                    <?= $proses['StatusAjuan']; ?></span>
                                            </td>
											<td>
												<a href="/kelurahan/detailajuan_i/<?= $proses['noAjuan']; ?>" class="btn btn-info btn-icon-split btn-sm">
													<span class="icon text-white-50">
														<i class="fas fa-search"></i>
													</span>
													<span class="text">Detail</span>
												</a>
                                              
                                            </td>
                                            
                                        </tr>
                                    <?php $no1++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ajuan Dalam Proses -->
    <div class="collapse" id="collapseExample2" data-parent="#accordion">
        <div style="font-size: 12px;" class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable1" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row text-center">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 7px;">No</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 45px;">No.Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 50px;">NIK</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 50px;">Nama</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Tgl. Ajuan: activate to sort column ascending" style="width: 40px;">Tgl. Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Jenis Bantuan: activate to sort column ascending" style="width: 30px;">Program Bantuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable1" rowspan="1" colspan="1" aria-label="Status Ajuan: activate to sort column ascending" style="width: 40px;">Status Ajuan</th>
										<th aria-controls="dataTable1" rowspan="1" colspan="1" style="width: 10px;">Aksi</th>
                                        
									</tr>
                                </thead>
                                <tbody>
                                    <?php $no1 = 0;
                                    foreach ($ajuan_proses as $proses) : ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1 text-center"><?= $no1 + 1; ?></td>
                                            <td><?= $proses['noAjuan']; ?></td>
                                            <td><?= $proses['NIK']; ?></td>
                                            <td><?= $proses['Nama']; ?></td>
                                            <?php
                                            $blnthn = explode('-', $proses['tgAjuan']);
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
                                            <td><?= $blnthn[2] . ' ' . $bulan[(int)$blnthn[1]] . ' ' . $blnthn[0]; ?></td>
                                            <td><?= $proses['NamaMitra']; ?>: <?= $proses['namaProgram']; ?></td>
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
                                                                                    } ?>>
                                                    <?= $proses['StatusAjuan']; ?></span>
                                            </td>
											<td>
                                                <a href="/kelurahan/detailajuan_i/<?= $proses['noAjuan']; ?>" class="btn btn-info btn-icon-split btn-sm">
													<span class="icon text-white-50">
														<i class="fas fa-search"></i>
													</span>
													<span class="text">Detail</span>
												</a>
                                            </td>
                                            
                                        </tr>
                                    <?php $no1++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ajuan Selesai -->
    <div class="collapse" id="collapseExample3" data-parent="#accordion">
        <div style="font-size: 12px;" class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable2" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row text-center">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 7px;">No</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 45px;">No.Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 50px;">NIK</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 50px;">Nama</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Tgl. Ajuan: activate to sort column ascending" style="width: 40px;">Tgl. Ajuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Jenis Bantuan: activate to sort column ascending" style="width: 30px;">Jenis Bantuan</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable2" rowspan="1" colspan="1" aria-label="Status Ajuan: activate to sort column ascending" style="width: 40px;">Status Ajuan</th>
										<th aria-controls="dataTable2" rowspan="1" colspan="1" style="width: 10px;">Aksi</th>
                                        
									</tr>
                                </thead>
                                <tbody>
                                    <?php $no2 = 0;
                                    foreach ($ajuan_selesai as $selesai) : ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1 text-center"><?= $no2 + 1; ?></td>
                                            <td><?= $selesai['noAjuan']; ?></td>
                                            <td><?= $selesai['NIK']; ?></td>
                                            <td><?= $selesai['Nama']; ?></td>
                                            <?php
                                            $blnthn = explode('-', $selesai['tgAjuan']);
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
                                            <td><?= $blnthn[2] . ' ' . $bulan[(int)$blnthn[1]] . ' ' . $blnthn[0]; ?></td>
                                            <td><?= $selesai['NamaMitra']; ?>: <?= $selesai['namaProgram']; ?></td>
                                            <td>
                                                <span style="border-radius: 5px;" <?php if ($selesai['idStsAjuan'] == 6) {
                                                                                        echo ("class='small text-white bg-danger p-1'");
                                                                                    } elseif ($selesai['idStsAjuan'] == 7) {
                                                                                        echo ("class='small text-white bg-success p-1'");
                                                                                    } ?>>
                                                    <?= $selesai['StatusAjuan']; ?></span>
                                            </td>
											<td>
                                                <a href="/kelurahan/detailajuan_i/<?= $selesai['noAjuan']; ?>" class="btn btn-info btn-icon-split btn-sm">
													<span class="icon text-white-50">
														<i class="fas fa-search"></i>
													</span>
													<span class="text">Detail</span>
												</a>
                                            </td>
                                            
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