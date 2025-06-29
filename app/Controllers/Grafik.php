<?php

namespace App\Controllers;
use App\Models\NilaiSiswaModel;
use App\Models\KriteriaModel;
use App\Models\NilaiKonversiModel;

class Grafik extends BaseController
{
    public function index(): string
    {
        return view('admin/grafik-kriteria');
    }

    public function pieData()
    {
        $model = new NilaiKonversiModel();

        // Ambil semua data konversi + nama_kriteria + bobot
        $results = $model->select('kriteria.nama_kriteria, kriteria.bobot, nilai_konversi.nilai')
            ->join('kriteria', 'kriteria.id = nilai_konversi.id_kriteria')
            ->findAll();

        // Kelompokkan data berdasarkan kriteria
        $grouped = [];

        foreach ($results as $row) {
            $kriteria = $row['nama_kriteria'];
            $bobot    = $row['bobot'];
            $nilai    = floatval($row['nilai']);

            if (!isset($grouped[$kriteria])) {
                $grouped[$kriteria] = [
                    'title'  => $kriteria,
                    'bobot'  => $bobot,
                    'labels' => [],
                    'data'   => [],
                    'count'  => [], // jumlah absolut
                ];
            }

            // Kelompokkan nilai konversi sama
            $labelKey = number_format($nilai, 2); // normalisasi float sebagai string

            if (!isset($grouped[$kriteria]['count'][$labelKey])) {
                $grouped[$kriteria]['count'][$labelKey] = 0;
            }

            $grouped[$kriteria]['count'][$labelKey]++;
        }

        // Hitung total dan persentase
        foreach ($grouped as $kriteria => &$entry) {
            $total = array_sum($entry['count']);

            foreach ($entry['count'] as $label => $jumlah) {
                $entry['labels'][] = $label;
                $entry['data'][] = round(($jumlah / $total) * 100, 2); // persen
            }

            unset($entry['count']); // hapus count, tidak perlu dikirim
        }

        // Reset index (jadi array of object)
        $final = array_values($grouped);

        return $this->response->setJSON($final);
    }

}
