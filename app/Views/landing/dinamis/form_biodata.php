<input type="hidden" name="status" value="<?= $status; ?>">
<div class="row">
    <div class="col-sm-12">
        <p class="alert <?= ($biodata == 404) ? 'alert-danger' : 'alert-info'; ?> mb-1">
            <?= $pesan; ?>
        </p>
    </div>
</div>

<?php if ($biodata != 404) { ?>
    <?php if ($status == 1) { ?>
        <!-- Nama Lengkap -->
        <div class="form-group row mt-3">
            <label for="nama" class="col-sm-4 col-form-label">Nama Lengkap</label>
            <div class="col-sm-8">
                <input type="text" name="nama" class="form-control" id="nama" required>
            </div>
        </div>
        <!-- Tempat Lahir -->
        <div class="form-group row">
            <label for="tempatlahir" class="col-sm-4 col-form-label">Tempat Lahir</label>
            <div class="col-sm-8">
                <input type="text" name="tempatlahir" class="form-control" id="tempatlahir" required>
            </div>
        </div>
        <!-- Tanggal Lahir -->
        <div class="form-group row">
            <label for="tgLahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-8">
                <input type="date" name="tgLahir" class="form-control" id="tgLahir" required>
            </div>
        </div>
        <!-- Jenis Kelamin -->
        <div class="form-group row">
            <label for="jenkel" class="col-sm-4 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="1">
                    <label class="form-check-label" for="exampleRadios1">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="2">
                    <label class="form-check-label" for="exampleRadios2">
                        Perempuan
                    </label>
                </div>
            </div>
        </div>
        <div id="alertGender" class="row" style="display: none;">
            <div class="col-12">
                <div class="alert alert-danger errorGender" role="alert">
                </div>
            </div>
        </div>
        <!-- Alamat -->
        <div class="form-group row">
            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
            <div class="col-sm-8">
                <input type="text" name="alamat" class="form-control" id="alamat" required>
            </div>
        </div>
        <!-- Kecamatan -->
        <div class="form-group row">
            <label for="kecamatan" class="col-sm-4 col-form-label">Kecamatan</label>
            <div class="col-sm-8">
                <!-- <select class="form-control" id="kecamatan" name="kecamatan" required onchange="getKec(this);"> -->
                <select class="form-control" id="kecamatan" name="kecamatan" required>
                    <option value="" selected disabled>Pilih Kecamatan</option>
                    <?php foreach ($kecamatan as $kec) { ?>
                        <option value="<?= $kec['idKec']; ?>"><?= $kec['Kecamatan']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <!-- Kelurahan -->
        <div class="form-group row">
            <label for="kelurahan" class="col-sm-4 col-form-label">Kelurahan</label>
            <div class="col-sm-8">
                <select class="form-control kelurahan" id="kelurahan" name="kelurahan" required>
                    <option selected disabled value="">Pilih Kelurahan</option>
                </select>
            </div>
        </div>
        <!-- Agama -->
        <div class="form-group row">
            <label for="agama" class="col-sm-4 col-form-label">Agama</label>
            <div class="col-sm-8">
                <select class="form-control" id="agama" name="agama" required>
                    <option>--Pilih Agama--</option>
                    <option value="1">Islam</option>
                    <option value="2">Protestan</option>
                    <option value="3">Katolik</option>
                    <option value="4">Hindu</option>
                    <option value="5">Buddha</option>
                    <option value="6">Konghucu</option>
                    <option value="7">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="telepon" class="col-sm-4 col-form-label">Telepon</label>
            <div class="col-sm-8">
                <input type="text" name="telepon" class="form-control" id="telepon" required>
                <small class="text-muted">Pastikan nomor telepon terisi dengan benar karena digunakan untuk keperluan komunikasi</small>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label">E-mail<span class="req">*</span></label>
            <div class="col-sm-8">
                <input type="email" name="email" class="form-control" id="email">
            </div>
        </div>
        <div class="form-group row">
            <label for="perhitungan" class="col-sm-4 col-form-label"><?= $text; ?></label>
            <div class="col-sm-8">
                <input type="number" name="jawabCpt" class="form-control" id="perhitungan">
                <input type="hidden" name="hslbenar" value="<?= md5($hasil); ?>">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <p class="small"><i><span class="req">*</span>boleh kosong jika tidak ada</i></p>
            </div>
        </div>
    <?php } elseif ($status == 0) { ?>
        <!-- Nama Lengkap -->
        <div class="form-group row mt-3">
            <label for="nama" class="col-sm-4 col-form-label">Nama Lengkap</label>
            <div class="col-sm-8">
                <input type="text" name="nama" class="form-control" id="nama" value="<?= $biodata['Nama']; ?>" required>
            </div>
        </div>
        <!-- Tempat Lahir -->
        <div class="form-group row">
            <label for="tempatlahir" class="col-sm-4 col-form-label">Tempat Lahir</label>
            <div class="col-sm-8">
                <input type="text" name="tempatlahir" class="form-control" id="tempatlahir" value="<?= $biodata['tempatLahir']; ?>" required>
            </div>
        </div>
        <!-- Tanggal Lahir -->
        <div class="form-group row">
            <label for="tgLahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-8">
                <input type="date" name="tgLahir" class="form-control" id="tgLahir" value="<?= $biodata['tgLahir']; ?>" readonly>
            </div>
        </div>
        <!-- Jenis Kelamin -->
        <div class="form-group row">
            <label for="jenkel" class="col-sm-4 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8">
                <div class="form-check">
                    <input <?= ($biodata['gender'] == 1) ? 'checked' : ''; ?> class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="1">
                    <label class="form-check-label" for="exampleRadios1">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input <?= ($biodata['gender'] == 2) ? 'checked' : ''; ?> class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="2">
                    <label class="form-check-label" for="exampleRadios2">
                        Perempuan
                    </label>
                </div>
            </div>
        </div>
        <div id="alertGender" class="row" style="display: none;">
            <div class="col-12">
                <div class="alert alert-danger errorGender" role="alert">
                </div>
            </div>
        </div>
        <!-- Alamat -->
        <div class="form-group row">
            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
            <div class="col-sm-8">
                <input type="text" name="alamat" class="form-control" id="alamat" value="<?= $biodata['Alamat']; ?>" required>
            </div>
        </div>
        <!-- Kecamatan -->
        <div class="form-group row">
            <label for="kecamatan" class="col-sm-4 col-form-label">Kecamatan</label>
            <div class="col-sm-8">
                <!-- <select class="form-control" id="kecamatan" name="kecamatan" required onchange="getKec(this);"> -->
                <select class="form-control" id="kecamatan" name="kecamatan" required>
                    <option value="" disabled>Pilih Kecamatan</option>
                    <?php foreach ($kecamatan as $kec) { ?>
                        <option <?= ($biodata['idKec'] == $kec['idKec']) ? 'selected' : ''; ?> value="<?= $kec['idKec']; ?>"><?= $kec['Kecamatan']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <!-- Kelurahan -->
        <div class="form-group row">
            <label for="kelurahan" class="col-sm-4 col-form-label">Kelurahan</label>
            <div class="col-sm-8">
                <select class="form-control kelurahan" id="kelurahan" name="kelurahan" required>
                    <?php foreach ($kelurahan as $kel) { ?>
                        <option <?= ($biodata['idKel'] == $kel['idKel']) ? 'selected' : ''; ?> value="<?= $kel['idKel']; ?>"><?= $kel['Kelurahan']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <!-- Agama -->
        <div class="form-group row">
            <label for="agama" class="col-sm-4 col-form-label">Agama</label>
            <div class="col-sm-8">
                <select class="form-control" id="agama" name="agama" required>
                    <option value="" disabled>Pilih Agama</option>
                    <option <?= ($biodata['idAgama'] == 1) ? 'selected' : ''; ?> value="1">Islam</option>
                    <option <?= ($biodata['idAgama'] == 2) ? 'selected' : ''; ?> value="2">Protestan</option>
                    <option <?= ($biodata['idAgama'] == 3) ? 'selected' : ''; ?> value="3">Katolik</option>
                    <option <?= ($biodata['idAgama'] == 4) ? 'selected' : ''; ?> value="4">Hindu</option>
                    <option <?= ($biodata['idAgama'] == 5) ? 'selected' : ''; ?> value="5">Buddha</option>
                    <option <?= ($biodata['idAgama'] == 6) ? 'selected' : ''; ?> value="6">Konghucu</option>
                    <option <?= ($biodata['idAgama'] == 7) ? 'selected' : ''; ?> value="7">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="telepon" class="col-sm-4 col-form-label">Telepon</label>
            <div class="col-sm-8">
                <input type="text" name="telepon" class="form-control" id="telepon" value="<?= $biodata['telepon']; ?>" required>
                <small class="text-muted">Pastikan nomor telepon terisi dengan benar karena digunakan untuk keperluan komunikasi</small>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label">E-mail<span class="req">*</span></label>
            <div class="col-sm-8">
                <input type="email" name="email" class="form-control" id="email" value="<?= $biodata['email']; ?>" required>
            </div>
        </div>

        <input type="hidden" name="jawabCpt" class="form-control" id="perhitungan" value="<?= $hasil; ?>">
        <input type="hidden" name="hslbenar" value="<?= md5($hasil); ?>">

        <!-- <div class="row mt-4">
            <div class="col">
                <p class="small"><i><span class="req">*</span>boleh kosong jika tidak ada</i></p>
            </div>
        </div> -->
    <?php } ?>
<?php } ?>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script src="<?= base_url(); ?>/extra/getKelurahan.js"></script>