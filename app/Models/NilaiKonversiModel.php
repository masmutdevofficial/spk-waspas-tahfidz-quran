<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiKonversiModel extends Model
{
    protected $table      = 'nilai_konversi';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id_siswa', 'id_kriteria', 'nilai'];
    protected $useTimestamps = true;
}
