<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table      = 'siswa';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_periode', 'nama_siswa', 'jenis_kelamin', 'tgl_lahir',
        'kelas', 'juz'
    ];
    protected $useTimestamps = true;
}
