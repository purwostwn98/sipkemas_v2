<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "muser";
    protected $primaryKey = 'idUser';
    protected $allowedFields = [
        'Namauser', 'User', 'Password', 'telepon', 'email'
    ];
}
