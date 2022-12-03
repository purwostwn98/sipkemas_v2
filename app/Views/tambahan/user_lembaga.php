<?php if ($privUser == 2) { ?>
    <div class="form-group row">
        <div class="col-sm-3 col-form-label text-sm-right pr-0">
            <label for="id-form-field-1" class="mb-0">Kelurahan</label>
        </div>
        <div class="col-sm-9">
            <select class="form-control" id="exampleFormControlSelect2" name="lembaga" required>
                <option value="" selected disabled>pilih kelurahan</option>
                <?php foreach ($lembaga as $key => $kel) { ?>
                    <option value="<?= $kel['idKel']; ?>"><?= $kel['Kelurahan']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
<?php } elseif ($privUser == 5) { ?>
    <div class="form-group row">
        <div class="col-sm-3 col-form-label text-sm-right pr-0">
            <label for="id-form-field-1" class="mb-0">Mitra</label>
        </div>
        <div class="col-sm-9">
            <select class="form-control" id="exampleFormControlSelect2" name="lembaga" required>
                <option value="" selected disabled>pilih mitra</option>
                <?php foreach ($lembaga as $i => $lbg) { ?>
                    <option value="<?= $lbg['idMitra']; ?>"><?= $lbg['NamaMitra']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
<?php } else { ?>
    <input type="hidden" name="lembaga" value="pemerintah">
<?php } ?>