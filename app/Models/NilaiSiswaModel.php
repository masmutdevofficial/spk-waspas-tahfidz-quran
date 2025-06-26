<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiSiswaModel extends Model
{
    protected $table      = 'nilai_siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_siswa', 'id_kriteria', 'nilai'];
    protected $useTimestamps = true;
}
