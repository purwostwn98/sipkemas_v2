<?php

namespace App\Models;

use CodeIgniter\Model;

class AjuanModel extends Model
{
    protected $table      = 'trajuan';
    protected $primaryKey = 'idAjuan';
    protected $useTimestamps = true;
    protected $createdField  = 'tgAjuan';
    protected $updatedField  = 'tgHasil';
    protected $allowedFields = [
        'noAjuan', 'idPemohon', 'tgAjuan', 'kodeBantuan', 'Keperluan', 'Kebutuhan', 'idStsAjuan', 'srtKetPemohon', 'idRecDinsos', 'ketRecDinsos',
        'tgRecDinsos', 'idRecKesra', 'ketRecKesra', 'tgRecKesra', 'idRecSurvey', 'ketRecSurvey', 'tgRecSurvey', 'tgHasil',
        'nilaiDisetujui', 'lastEditor', 'eSik', 'idJnsAjuan'
    ];
}

class UploadModel extends Model
{
    protected $table      = 'trupload';
    protected $primaryKey = 'idUpload';
    protected $allowedFields = [
        'noAjuan', 'idSyarat', 'namaFile'
    ];
}

class AjuanLbgModel extends Model
{
    protected $table      = 'trlembaga';
    protected $primaryKey = 'idLbgAjuan';
    protected $allowedFields = [
        'noAjuan', 'namaLembaga', 'alamat', 'tglBerdiri', 'Akta', 'SuratTerdaftar', 'SuratDomisili'
    ];
}

class MitraModel extends Model
{
    protected $table = 'mmitra';
    protected $primaryKey = 'idMitra';
}
