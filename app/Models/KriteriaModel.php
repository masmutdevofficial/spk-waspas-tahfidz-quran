<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table      = 'kriteria';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama_kriteria', 'jenis', 'bobot'];
    protected $useTimestamps = true;
}
