<?php

namespace App\Controllers;

use App\Models\HasilPenilaianModel;
use App\Models\SiswaModel;
use App\Models\NilaiSiswaModel;
use App\Models\KriteriaModel;
use App\Models\NilaiKonversiModel;
use App\Models\PeriodeModel;

class Hasil extends BaseController
{
    public function index()
    {
        $modelWaspas   = new HasilPenilaianModel();
        $modelSiswa    = new SiswaModel();
        $modelPeriode  = new PeriodeModel();

        $filterPeriode = $this->request->getGet('periode');

        $data['periode']   = $modelPeriode->findAll();
        $data['filter_id'] = $filterPeriode;

        $query = $modelWaspas
            ->select('nilai_waspas.*, siswa.nama_siswa, siswa.id_periode')
            ->join('siswa', 'siswa.id = nilai_waspas.id_siswa');

        if (!empty($filterPeriode)) {
            $query->where('siswa.id_periode', $filterPeriode);
        }

        // 🔽 Urutkan berdasarkan Qi tertinggi ke terendah
        $query->orderBy('nilai_qi', 'DESC');

        $data['waspas'] = $query->findAll();
        $data['siswa']  = $modelSiswa->findAll();

        return view('admin/hasil-penilaian', $data);
    }

    public function tambah()
    {
        $model = new HasilPenilaianModel();
        $data = $this->request->getPost();

        $model->save([
            'id_siswa'           => $data['id_siswa'],
            'nilai_konversi'     => $data['nilai_konversi'],
            'nilai_normalisasi'  => $data['nilai_normalisasi'],
            'nilai_wsm'          => $data['nilai_wsm'],
            'nilai_wpm'          => $data['nilai_wpm'],
            'nilai_qi'           => $data['nilai_qi'],
            'status_kelulusan'   => $data['status_kelulusan'] ?? 'Tidak Lulus',
        ]);

        return redirect()->to('/hasil-penilaian')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        $model = new HasilPenilaianModel();
        $data = $this->request->getPost();

        $model->update($id, [
            'id_siswa'           => $data['id_siswa'],
            'nilai_konversi'     => $data['nilai_konversi'],
            'nilai_normalisasi'  => $data['nilai_normalisasi'],
            'nilai_wsm'          => $data['nilai_wsm'],
            'nilai_wpm'          => $data['nilai_wpm'],
            'nilai_qi'           => $data['nilai_qi'],
            'status_kelulusan'   => $data['status_kelulusan'],
        ]);

        return redirect()->to('/hasil-penilaian')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $model = new HasilPenilaianModel();
        $model->delete($id);

        return redirect()->to('/hasil-penilaian')->with('success', 'Data berhasil dihapus');
    }

    public function cetakHasil()
    {
        $siswaModel = new SiswaModel();
        $nilaiModel = new NilaiSiswaModel();
        $waspasModel = new HasilPenilaianModel();
        $kriteriaModel = new KriteriaModel();

        $kriteriaList = $kriteriaModel->findAll();

        $siswaList = $siswaModel->findAll();
        $siswaData = [];

        foreach ($siswaList as $s) {
            $nilai = $nilaiModel
                ->where('id_siswa', $s['id'])
                ->findAll();

            $waspas = $waspasModel
                ->where('id_siswa', $s['id'])
                ->first();

            $temp = [
                'nama' => $s['nama_siswa'],
                'nilai' => [],
                'qi' => $waspas['nilai_qi'] ?? 0,
                'status' => $waspas['status_kelulusan'] ?? 'Tidak Lulus',
            ];

            foreach ($nilai as $n) {
                $temp['nilai'][$n['id_kriteria']] = [
                    'nilai' => $n['nilai'],
                ];
            }

            $siswaData[] = $temp;
        }

        return view('admin/cetak-hasil-penilaian', compact('siswaData'));
    }

    public function grafik()
    {
        $model = new NilaiKonversiModel();

        $periodeId = $this->request->getGet('periode');

        $query = $model->select('siswa.nama_siswa, kriteria.nama_kriteria, nilai_konversi.nilai')
            ->join('siswa', 'siswa.id = nilai_konversi.id_siswa')
            ->join('kriteria', 'kriteria.id = nilai_konversi.id_kriteria');

        if (!empty($periodeId)) {
            $query->where('siswa.id_periode', $periodeId);
        }

        $results = $query->orderBy('siswa.id')->orderBy('kriteria.id')->findAll();

        // Struktur data grafik
        $labels = [];
        $datasets = [];

        foreach ($results as $row) {
            $namaSiswa     = $row['nama_siswa'];
            $namaKriteria  = $row['nama_kriteria'];
            $nilai         = floatval($row['nilai']);

            if (!in_array($namaSiswa, $labels)) {
                $labels[] = $namaSiswa;
            }

            if (!isset($datasets[$namaKriteria])) {
                $datasets[$namaKriteria] = [];
            }

            $datasets[$namaKriteria][] = $nilai;
        }

        // Format Chart.js datasets
        $colors = ['#60a5fa', '#34d399', '#fbbf24', '#f87171', '#a78bfa'];
        $datasetsFormatted = [];
        $i = 0;

        foreach ($datasets as $kriteria => $nilaiList) {
            $datasetsFormatted[] = [
                'label' => $kriteria,
                'data' => $nilaiList,
                'backgroundColor' => $colors[$i % count($colors)],
            ];
            $i++;
        }

        return $this->response->setJSON([
            'labels'   => $labels,
            'datasets' => $datasetsFormatted,
        ]);
    }

}
