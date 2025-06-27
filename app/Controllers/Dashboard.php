<?php

namespace App\Controllers;
use App\Models\SiswaModel;
use App\Models\HasilPenilaianModel;

class Dashboard extends BaseController
{
public function index()
{
    $siswaModel = new SiswaModel();
    $hasilModel = new HasilPenilaianModel();

    $data['terdaftar'] = $siswaModel->countAll();
    $data['lulus'] = $hasilModel->where('status_kelulusan', 'Lulus')->countAllResults();
    $data['tidakLulus'] = $hasilModel->where('status_kelulusan', 'Tidak Lulus')->countAllResults();

    return view('admin/dashboard', $data);
}
}
