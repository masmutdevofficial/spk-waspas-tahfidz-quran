<?php

namespace App\Controllers;

use App\Models\HasilPenilaianModel;
use App\Models\SiswaModel;

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
}
