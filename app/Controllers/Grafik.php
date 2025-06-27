<?php

namespace App\Controllers;
use App\Models\NilaiSiswaModel;
use App\Models\KriteriaModel;

class Grafik extends BaseController
{
    public function index(): string
    {
        return view('admin/grafik-kriteria');
    }

    public function pieData()
    {
        $kriteriaModel = new KriteriaModel();

        // Ambil semua kriteria
        $kriteria = $kriteriaModel->findAll();

        $labels = [];
        $jumlah = [];

        foreach ($kriteria as $k) {
            $labels[] = $k['nama_kriteria'];
            $jumlah[] = $k['bobot'];
        }

        return $this->response->setJSON([
            'labels' => $labels,
            'data'   => $jumlah,
        ]);
    }
}
