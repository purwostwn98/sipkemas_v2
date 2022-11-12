<option selected value="" hidden>Pilih Kelurahan</option>
<?php foreach ($kelurahan as $row) : ?>
    <option value="<?= $row['idKel']; ?>"><?= $row['Kelurahan']; ?></option>
<?php endforeach; ?>