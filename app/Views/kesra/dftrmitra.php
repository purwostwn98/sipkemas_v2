<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Forum Kesra</h1>
    <button data-toggle="modal" data-target="#filterMitra" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm ml-2 btnPdf" name="btnPdf">
        <i class="fa fa-file-pdf fa-sm text-white-50"></i> &nbsp;&nbsp;Report Mitra
    </button>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table">
            <thead class="bg-info text-white">
                <tr>
                    <th style="width: 10%;" class="text-center" scope="col">ID Mitra</th>
                    <th scope="col">Nama Mitra</th>
                    <th scope="col">Alamat</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-light border-bottom-info">
                <?php foreach ($mitra as $mit) { ?>
                    <tr class="bg-white">
                        <th class="text-center" scope="row"><?= $mit['idMitra']; ?></th>
                        <td style="font-weight: bold;"><?= $mit['NamaMitra']; ?></td>
                        <td><?= $mit['Alamat']; ?></td>
                        <td class="text-center">
                            <a href="/mitra/dashboard?idMitra=<?= $mit['idMitra']; ?>" class="btn btn-info btn-circle">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal filter mitra -->
<div class="modal fade" id="filterMitra" tabindex="-1" role="dialog" aria-labelledby="filterMitraLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="filterMitraLabel"><strong>Filter Mitra</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("/kesra/mitraPdf", ['class' => 'formFilter']); ?>
            <!-- <form method="POST" id="formFilter" action="/kesra/mitraPdf"> -->
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="inputAddress">Pilih Periode</label>
                    <select class="form-control" name="periode" required>
                        <option value="semua" selected>Semua Periode</option>
                        <?php for ($i = date('Y'); $i >= 2020; $i -= 1) : ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Mitra</label>
                    <select class="form-control" name="idMitra" required>
                        <option value="" selected disabled>Pilih Mitra</option>
                        <?php foreach ($mitra as $mtr) : ?>
                            <option value="<?= $mtr['idMitra']; ?>"><?= $mtr['NamaMitra']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" id="btnEkspor" class="btn btn-danger btnFilter" name="submit">Ekspor PDF</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min2.js"></script>

<script {csp-script-nonce}>
    $(document).ready(function() {
        $('.formFilter').submit(function() {
            location.reload();
        });
    });
</script>


<?= $this->endSection(); ?>