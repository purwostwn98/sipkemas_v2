<?= $this->extend("/layout/template_depan.php"); ?>
<?= $this->section("konten"); ?>

<div style="margin-top: 110px;" class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 text-gray-800">Formulir Ajuan Bantuan</h4>
    </div>
    <?= form_open_multipart("", ['class' => 'formAjukan']); ?>
    <?= csrf_field(); ?>
    <!-- Form Ajuan -->
    <div class="card shadow mb-4">
        <div style="background-color: #2487ce;" class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-white">Ajuan Bantuan</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <label for="">Jenis Bantuan</label>
                </div>
                <div class="col-sm-4">
                    <div class="form-group has-danger">
                        <select class="form-control col-sm-12  border-left-info animated--grow-in" name="jnsbantuan" id="div" onchange="getval(this);">
                            <option value="0">Individu</option>
                            <option value="1">Lembaga</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <label for="">Program Bantuan</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-group has-danger">
                        <select class="form-control col-sm-12  border-left-info animated--grow-in" name="kodeBantuan" id="kodeBantuan" onchange="getBantuan(this);">
                            <option value="" disabled selected>Pilih Bantuan</option>
                            <?php foreach ($bantuan as $row) { ?>
                                <option value="<?= $row['kodeBantuan']; ?>"><?= $row['NamaMitra']; ?>: <?= $row['namaProgram']; ?></option>
                            <?php } ?>
                        </select>
                        <small id="nilai0" class="form-text text-primary"><i>Keterangan detail Program Bantuan silahkan buka di halaman depan</i></small>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"> </div>
                <div class="col-sm-4">
                    <label for="">Nilai Ajuan</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-group has-danger">
                        <label class="sr-only" for="inlineFormInputGroup">Nilai Ajuan</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="kebutuhan" id="inputku" placeholder="-" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                        </div>
                        <small id="nilai" class="form-text text-primary"><i>Isikan nominal bantuan yang dibutuhkan misalnya 750000</i></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"> </div>
                <div class="col-sm-4">
                    <label for="">Deskripsi Permohonan</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-group has-danger">
                        <textarea type="text" rows="3" class="form-control col-sm-12  border-left-info animated--grow-in" name="keperluan" id="keperluan" value=""></textarea>
                        <small id="nilai1" class="form-text text-primary"><i>Isikan alasan mengapa mengajukan dan untuk apa bantuan digunakan</i></small>
                    </div>
                </div>
            </div>
            <div class="srtKeterangan">
                <div class="row">
                    <div class="col-sm-1"> </div>
                    <div class="col-sm-4">
                        <label for="">Surat Keterangan Pemohon</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-danger">
                            <input class="form-control col-sm-12  border-left-info animated--grow-in" type="file" id="srtKetPemohon" name="srtKetPemohon">
                            <small id="nilai2" class="form-text text-primary"><i>Surat Keterangan Tidak Mampu dari Kelurahan bila belum terdaftar di eSik dalam format pdf. Format surat keterangan dapat didownload </i></small><a class="px-3 bg-warning text-white" style="border-radius: 5px;" target="_blank" href="<?= base_url(); ?>/dokumen/SuKet.pdf">DI SINI</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Identitas Lembaga -->
    <div id="form_lembaga" style="display: none;" class="card shadow mb-4">
        <div class="card-header py-3 bg-secondary">
            <h6 class="m-0 font-weight-bold text-white">Identitas Lembaga</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <label for="">Nama Lembaga</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-group has-danger">
                        <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="namaLbg" id="namaLbg" value="">
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <label for="">Alamat Lembaga</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-group has-danger">
                        <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="alamatLbg" id="alamatLbg" value="">
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <label for="">No. Akta Lembaga</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-group has-danger">
                        <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="noAkta" id="noAkta" placeholder="Jika tidak ada isikan 0">
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>
    <!-- Persyaratan Ajuan -->
    <div class="card shadow mb-4">
        <div style="background-color: #2487ce;" class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-white">Persyaratan Bantuan</h6>
        </div>
        <div class="card-body unggahSyarat">
            Pilih program bantuan terlebih dahulu
        </div>
    </div>
    <input type="hidden" name="nik" value="<?= $nik; ?>">
    <div class="row">
        <div class="col-sm-1"> </div>
        <div class="checkbox mx-3">
            <label for="persetujuan"><input type="checkbox" name="persetujuan" id="persetujuan" required="">
                Menyatakan bahwa apa yang tertulis pada formulir dan syarat yang diunggah benar adanya dan bersedia dibatalkan ajuannya apabila
                data tidak valid.</label>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-4"> </div>
        <button type="submit" class="btn btn-success btn-md btn-icon-split btnAjukan" target="_blank"><span class="icon text-white-50"> <i class="fas fa-check"></i></span><span class="text">Ajukan</span></button>&nbsp;&nbsp;
        <button class="btn btn-danger btn-md btn-icon-split" onclick="del(this.value)"><span class="icon text-white-50"> <i class="fas fa-trash"></i></span><span class="text">Batal</span></button>
    </div>
    <?= form_close(); ?>
</div>


<script type="text/javascript" src="<?= base_url(); ?>/js/angkaRibuan.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min2.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    //Untuk hide/show form Lembaga
    function getval(sel) {
        if (sel.value == "0") {
            $("#form_lembaga").css("display", "none");
            $('.srtKeterangan').css("display", "block");
        } else if (sel.value == "1") {
            $("#form_lembaga").css("display", "block");
            $('.srtKeterangan').css("display", "none");
        }
    }

    //Untuk show form syarat
    function getBantuan(sel) {
        var kodeBantuan = sel.value;
        console.log(kodeBantuan);
        $.ajax({
            url: "<?= site_url('dinamis/form_syarat'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                kodeBantuan: kodeBantuan
            },
            success: function(response) {
                $('.unggahSyarat').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<!-- POST FORM AJUAN -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.formAjukan').submit(function(e) {
            e.preventDefault();
            let form = $('.formAjukan')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?= site_url('pemohon/ajukanBantuan'); ?>",
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnAjukan').prop('disabled', true);
                    $('.btnAjukan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnAjukan').prop('disabled', false);
                    $('.btnAjukan').html("<span class='icon text-white-50'> <i class='fas fa-check'></i></span><span class='text'>Ajukan</span>");
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.jnsbantuan) {
                            swal("Mohon Maaf!", response.error.jnsbantuan, "error");
                        } else if (response.error.kodeBantuan) {
                            swal("Mohon Maaf!", response.error.kodeBantuan, "error");
                            // $('.errorGender').html(response.error.gender);
                        } else if (response.error.srtKetPemohon) {
                            swal("Mohon Maaf!", response.error.srtKetPemohon, "error");
                        } else if (response.error.files) {
                            swal("Mohon Maaf!", response.error.files, "error");
                        }
                        $("input[name='csrf_test_name']").val(response.error.token);
                    }
                    if (response.a) {
                        if (response.a.b) {
                            swal("Mohon Maaf!", response.a.b, "error");
                            $('.errortext').html(response.a.b);
                        } else {
                            $('#alertError').css("display", "none");
                            $('.errortext').html('');
                        }
                        $("input[name='csrf_test_name']").val(response.a.token);
                    }
                    if (response.berhasil) {
                        swal({
                            title: response.berhasil.pesan,
                            text: "Selamat ajuan Anda berhasil diajukan. Perkembangan ajuan dapat dipantau melalui form cek ajuan di web ini",
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
        });
    });
</script>
<?= $this->endSection(); ?>