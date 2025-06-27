<?php

namespace App\Controllers;

use App\Models\HasilPenilaianModel;
use App\Models\SiswaModel;
use App\Models\NilaiSiswaModel;
use App\Models\KriteriaModel;

class Hasil extends BaseController
{
    public function index()
    {
        $modelWaspas = new HasilPenilaianModel();
        $modelSiswa  = new SiswaModel();

        $data['waspas'] = $modelWaspas
            ->select('nilai_waspas.*, siswa.nama_siswa')
            ->join('siswa', 'siswa.id = nilai_waspas.id_siswa')
            ->findAll();

        $data['siswa'] = $modelSiswa->findAll();

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
        $model = new HasilPenilaianModel();
        $siswaModel = new SiswaModel();

        $data = $model
            ->select('nilai_waspas.*, siswa.nama_siswa')
            ->join('siswa', 'siswa.id = nilai_waspas.id_siswa')
            ->findAll();

        $labels = [];
        $wsm = [];
        $wpm = [];
        $qi = [];

        foreach ($data as $item) {
            $labels[] = $item['nama_siswa'];
            $wsm[]    = (float) $item['nilai_wsm'];
            $wpm[]    = (float) $item['nilai_wpm'];
            $qi[]     = (float) $item['nilai_qi'];
        }

        return $this->response->setJSON([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'WSM',
                    'data' => $wsm,
                    'backgroundColor' => '#60a5fa',
                ],
                [
                    'label' => 'WPM',
                    'data' => $wpm,
                    'backgroundColor' => '#34d399',
                ],
                [
                    'label' => 'Nilai Q',
                    'data' => $qi,
                    'backgroundColor' => '#f97316',
                ],
            ]
        ]);
    }
}
