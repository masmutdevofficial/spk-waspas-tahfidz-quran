<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilPenilaianModel extends Model
{
    protected $table      = 'nilai_waspas';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_siswa',
        'nilai_wsm',
        'nilai_wpm',
        'nilai_qi',
        'status_kelulusan'
    ];

    protected $useTimestamps = true;
}
