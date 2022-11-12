<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Program Bantuan</h1>
    <a href="/kesra/frTambahProgram" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-2">
        <i class="fa fa-plus-circle fa-sm text-white-50"></i> Tambah Program
    </a>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="collapse show" id="collapseExample1" data-parent="#accordion">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead>
                                            <tr class="text-center" role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 10px;">No</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 30px;">Kode</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 45px;">Nama Program</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 45px;">Mitra</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 45px;">Status</th>
                                                <th aria-controls="dataTable" rowspan="1" colspan="1" style="width: 10px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($bantuan as $row) : ?>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1 text-center"><?= $no + 1; ?></td>
                                                    <td><?= $row['kodeBantuan']; ?></td>
                                                    <td><?= $row['namaProgram'] ?></td>
                                                    <td><?= $row['NamaMitra'] ?></td>
                                                    <td class="text-center"><?= ($row['StatusProgram'] == 'active') ? 'Aktif' : 'Tidak aktif' ?></td>
                                                    <td class="text-center">
                                                        <a href="/kesra/editProgram?kode=<?= $row['idBantuan']; ?>" class="btn btn-warning btn-circle">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <input type="hidden" class="csrf_input" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                        <button onclick="hapus('<?= $row['kodeBantuan']; ?>')" class="btn btn-danger btn-circle">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php $no++;
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
    </div>
</div>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
<script type="text/javascript" src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min2.js"></script>
<script>
    function hapus(kodeBantuan) {
        var csrfName = $('.csrf_input').attr('name'); // CSRF Token name
        var csrfHash = $('.csrf_input').val(); // CSRF hash
        swal({
                title: "Peringatan!",
                text: "Anda yakin ingin menghapus program?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?= site_url('kesra/doHapusProgram'); ?>",
                        type: "POST",
                        dataType: "json",
                        data: {
                            kodeBantuan: kodeBantuan,
                            [csrfName]: csrfHash
                        },
                        success: function(response) {
                            if (response.notallowed) {
                                swal("Tidak diizinkan!", response.notallowed, "warning")
                            } else if (response.berhasil) {
                                swal("Berhasil!", response.berhasil, "success").then((value) => {
                                    location.reload();
                                });
                            } else if (response.gagal) {
                                swal("Gagal!", response.gagal, "danger").then((value) => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
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