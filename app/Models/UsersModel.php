<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "muser";
    protected $primaryKey = 'idUser';
    protected $allowedFields = [
        'idPrivUser', 'Namauser', 'User', 'Password', 'telepon', 'email', 'idLembaga', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
}

class PrivModel extends Model
{
    protected $table = "eprivuser";
    protected $primaryKey = 'idPrivUser';
}
