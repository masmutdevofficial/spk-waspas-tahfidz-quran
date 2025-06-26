<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodeModel extends Model
{
    protected $table      = 'periode';
    protected $primaryKey = 'id';

    protected $allowedFields = ['tahun', 'semester'];
    protected $useTimestamps = true;
}
