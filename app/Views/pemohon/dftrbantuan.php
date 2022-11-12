<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ajuan Bantuan</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Pendaftaran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead class="bg-primary text-white">
                                        <tr role="row">
                                            <th aria-controls="dataTable" rowspan="1" colspan="1" style="width: 40px;"><i class="fas fa-location-arrow"></i></th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="No: activate to sort column ascending" style="width: 20px;">No</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Jenis Bantuan: activate to sort column descending" style="width: 57px;">Jenis Bantuan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Keterangan: activate to sort column ascending" style="width: 100px;">Keterangan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 49px;">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="E-SIK: activate to sort column ascending" style="width: 49px;">E-SIK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr role="row" class="even">
                                            <td>
                                                <a href="/pemohon/timeline">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </td>
                                            <td class="sorting_1">1</td>
                                            <td><b>Paket A:</b> Bantuan Sosial Kemasyarakatan</td>
                                            <td><b>Pendaftaran:</b> 18 April 2021</td>
                                            <td><a href="#" class="btn btn-sm btn-info btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-flag fa-sm"></i>
                                                    </span>
                                                    <span class="text">Aktif</span>
                                                </a>
                                            </td>
                                            <td><a href="#" class="btn btn-sm btn-success btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-check fa-sm"></i>
                                                    </span>
                                                    <span class="text">Terdaftar</span>
                                                </a>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>