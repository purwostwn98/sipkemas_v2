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
        <h1 class="h3 mb-0 text-gray-800">Program Bantuan</h1>
    </div>
    <div class="col-auto">
        <a href="/kesra/frTambahProgram" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-2">
            <i class="fa fa-plus-circle fa-sm text-white-50"></i> Tambah Program
        </a>
    </div>
</div>
<div id="accordion" class="card shadow mb-4">
    <!-- Tabel Permintaa Persetujuan -->

    <div class="collapse show" id="collapseExample1" data-parent="#accordion">

        <div style="font-size: 12px;" class="card-body">
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
                                        <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 45px;">Jenis Bantuan</th> -->
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 25px;">Status</th>
                                        <th aria-controls="dataTable" rowspan="1" colspan="1" style="width: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    //print_r($program); exit;
                                    foreach ($program as $baru) : ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1 text-center"><?= $no + 1; ?></td>
                                            <td><?= $baru->kodeBantuan; ?></td>
                                            <td><?= $baru->namaProgram; ?></td>
                                            <!-- <td><?= $baru->JnsBantuan; ?></td> -->
                                            <td><?= ($baru->StatusProgram = 'active') ? 'Aktif' : 'Tidak Aktif' ?></td>
                                            <td>
                                                <a href="/mitra/detailProgram?kode=<?= $baru->idBantuan; ?>" class="btn btn-primary btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-search"></i>
                                                    </span>
                                                    <span class="text">Detail</span>
                                                </a>
                                                <a href="/mitra/pemohonpdf/<?= $baru->idBantuan; ?>" id='pdf' class="btn btn-danger btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="fa fa-file-pdf"></i>
                                                    </span>
                                                    <span class="text">PDF</span>
                                                </a>
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
<script type="text/javascript" src="<?= base_url(); ?>/js/angkaRibuan.js"></script>

<script>
    function getval(sel) {
        if (sel.value == "1") {
            $(".disetujui").css("display", "block");
            $(".nilai").css("display", "block");
        } else if (sel.value == "2") {
            $(".disetujui").css("display", "none");
        } else if (sel.value == "3") {
            $(".disetujui").css("display", "block");
            $(".nilai").css("display", "none");
        }
    }

    function getnilai(sel) {
        if (sel.value == "1") {
            $(".nilai2").css("display", "block");
        } else if (sel.value == "3") {
            $(".nilai2").css("display", "none");
        }
    }
</script>

<script type="text/javascript" src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min2.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
<!-- POST FORM AJUAN -->
<script type="text/javascript">
    $(document).ready(function() {
        //Btn baru click
        $('#pdfx').click(function(e) {
            e.preventDefault();


            swal({
                    title: "Anda yakin?",
                    text: "Dengan mengkonfirmasi ajuan, Anda tidak dapat lagi merubah rekomendasi",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "post",
                            url: $(".formTindakanBaru").attr('action'),
                            data: $(".formTindakanBaru").serialize(),
                            dataType: "json",
                            beforeSend: function() {
                                $('.btnBaru').prop('disabled', true);
                                $('.btnBaru').html('<i class="fa fa-spin fa-spinner"></i>');
                            },
                            complete: function() {
                                $('.btnBaru').prop('disabled', false);
                                $('.btnBaru').html("<span class='icon text-white-50'><i class='fas fa-save'></i></span><span class='text'>Konfirmasi ke Kesra</span>");
                            },
                            success: function(response) {
                                if (response.error) {
                                    if (response.error.persetujuan) {
                                        swal("Mohon Maaf!", response.error.persetujuan, "error");
                                    } else if (response.error.nilai) {
                                        swal("Mohon Maaf!", response.error.nilai, "error");
                                    }
                                }
                                if (response.berhasil) {
                                    swal({
                                        title: "Sukses",
                                        text: response.berhasil.pesan,
                                        icon: "success",
                                        button: "Ok",
                                    }).then((value) => {
                                        window.location = response.berhasil.link;
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
        });
        //Btn survey click


        $('.btnSurvey').click(function(e) {
            e.preventDefault();
            swal({
                    title: "Anda yakin?",
                    text: "Dengan mengkonfirmasi ajuan, Anda tidak dapat lagi merubah rekomendasi",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "post",
                            url: $(".formTindakanSurvey").attr('action'),
                            data: $(".formTindakanSurvey").serialize(),
                            dataType: "json",
                            beforeSend: function() {
                                $('.btnSurvey').prop('disabled', true);
                                $('.btnSurvey').html('<i class="fa fa-spin fa-spinner"></i>');
                            },
                            complete: function() {
                                $('.btnSurvey').prop('disabled', false);
                                $('.btnSurvey').html("<span class='icon text-white-50'><i class='fas fa-save'></i></span><span class='text'>Konfirmasi ke Kesra</span>");
                            },
                            success: function(response) {
                                if (response.error) {
                                    if (response.error.persetujuan) {
                                        swal("Mohon Maaf!", response.error.persetujuan, "error");
                                    } else if (response.error.nilai) {
                                        swal("Mohon Maaf!", response.error.nilai, "error");
                                    }
                                }
                                if (response.berhasil) {
                                    swal({
                                        title: "Sukses",
                                        text: response.berhasil.pesan,
                                        icon: "success",
                                        button: "Ok",
                                    }).then((value) => {
                                        window.location = response.berhasil.link;
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
        });
    });
</script>


<?= $this->endSection(); ?>