<?= $this->extend("/layout/template.php"); ?>
<?= $this->section("konten"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form Data Pemohon</h1>
</div>

<!-- Content Row Data Pemohon-->

<form>
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap">
        </div>
    </div>
    <div class="form-group row">
        <label for="tempatlahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="tempatlahir" placeholder="Tempat Lahir">
        </div>
    </div>
    <div class="form-group row">
        <label for="tgllahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
        <div class="col-md-5">
            <input type="date" class="form-control" id="tgllahir">
        </div>
    </div>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="1">
                    <label class="form-check-label" for="gender1">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="2">
                    <label class="form-check-label" for="gender2">
                        Perempuan
                    </label>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="form-group row">
        <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="Alamat" placeholder="Nama Jalan atau RT/RW">
        </div>
    </div>
    <div class="form-group row">
        <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
        <div class="col-md-10">
            <select id="kecamatan" class="form-control">
                <option disabled selected>--Pilih--</option>
                <option>Banjarsari</option>
                <option>Jebres</option>
                <option>Laweyan</option>
                <option>Serengan</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
        <div class="col-md-10">
            <select id="kelurahan" class="form-control">
                <option disabled selected>--Pilih--</option>
                <option>Banyuanyar</option>
                <option>Kadipiro</option>
                <option>Keprabon</option>
                <option>Manahan</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="Agama" class="col-sm-2 col-form-label">Agama</label>
        <div class="col-md-10">
            <select id="Agama" class="form-control">
                <option disabled selected>--Pilih--</option>
                <option>Islam</option>
                <option>Protestan</option>
                <option>Katolik</option>
                <option>Hindu</option>
                <option>Buddha</option>
                <option>Konghucu</option>
                <option>Lainnya</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="telepon" placeholder="No. Telepon">
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-md-10">
            <input type="email" class="form-control" id="email" placeholder="Email">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
            <a href="/pemohon/dtpemohon" type="button" class="d-none d-sm-inline-block btn btn-warning shadow-sm"><i class="fas fa-window-close text-white-50"></i> Batal</a>
            <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-save text-white-50"></i> Simpan</button>
        </div>
    </div>
</form>
<?= $this->endSection(); ?>