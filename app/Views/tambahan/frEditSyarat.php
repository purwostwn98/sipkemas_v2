<div class="modal fade" id="editSyarat" tabindex="-1" role="dialog" aria-labelledby="editSyaratLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="editSyaratLabel">Edit Syarat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("/kesra/doEditSyarat", ['class' => 'formEditSyarat']); ?>
            <?= csrf_field(); ?>
            <!-- <form> -->
            <input type="hidden" name="idSyarat" value="<?= $syarat['idSyarat']; ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label style="font-weight: bold" for="namaSyarat">Nama Syarat</label>
                    <input type="text" name="namaSyarat" class="form-control border-left-primary" id="namaSyarat" value="<?= $syarat['Syarat']; ?>" required>
                </div>
                <div class="form-group">
                    <label style="font-weight: bold" for="stsSyarat">Status</label>
                    <select name="StatusSyarat" class="form-control border-left-primary" aria-describedby="stsHelp" id="stsSyarat">
                        <option <?= ($syarat['StatusSyarat'] == 'active') ? 'selected' : '' ?> value="active">Aktif</option>
                        <option <?= ($syarat['StatusSyarat'] == 'nonactive') ? 'selected' : '' ?> value="nonactive">Tidak aktif</option>
                    </select>
                    <small id="stsHelp" class="form-text text-primary"><i>Syarat yang tidak aktif, tidak akan ditampilkan pada halaman form ajuan</i></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" role="button" class="btn btn-primary btnSimpan">Simpan Perubahan</button>
            </div>
            <!-- </form> -->
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.formEditSyarat').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnSimpan').prop('disabled', true);
                    $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnSimpan').prop('disabled', false);
                    $('.btnSimpan').html('Simpan Perubahan');
                },
                success: function(response) {
                    if (response.berhasil) {
                        swal("Berhasil!", response.berhasil, "success").then((value) => {
                            location.reload();
                        });
                        $('#editSyarat').modal('hide');
                    } else if (response.gagal) {
                        swal("Gagal!", response.gagal, "danger").then((value) => {
                            location.reload();
                        });
                        $('#editSyarat').modal('hide');
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