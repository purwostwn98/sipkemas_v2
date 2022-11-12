<?php

namespace App\Models;

use CodeIgniter\Model;

class BantuanModel extends Model
{
    protected $table      = 'trbantuan';
    protected $primaryKey = 'idBantuan';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'kodeBantuan', 'namaProgram', 'desBantuan', 'idMitra', 'tgInput', 'JnsBantuan', 'NilaiBantuan', 'StatusProgram', 'tahun', 'kuota'
    ];
}

class SyaratModel extends Model
{
    protected $table      = 'trsyarat';
    protected $primaryKey = 'idSyarat';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'kodeBantuan', 'Syarat', 'StatusSyarat'
    ];
}
