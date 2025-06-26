<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\PeriodeModel;

class Siswa extends BaseController
{
    public function index(): string
    {
        $siswaModel   = new SiswaModel();
        $periodeModel = new PeriodeModel();

        $data['siswa']   = $siswaModel->select('siswa.*, periode.tahun, periode.semester')
                                      ->join('periode', 'periode.id = siswa.id_periode')
                                      ->findAll();

        $data['periode'] = $periodeModel->findAll();

        return view('admin/data-siswa', $data);
    }

    public function tambah()
    {
        $siswaModel = new SiswaModel();
        $data = $this->request->getPost();

        $siswaModel->save([
            'id_periode'    => $data['id_periode'],
            'nama_siswa'    => $data['nama_siswa'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'tgl_lahir'     => $data['tgl_lahir'],
            'kelas'         => $data['kelas'],
            'juz'           => $data['juz'],
        ]);

        return redirect()->to('/data-siswa')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function update($id)
    {
        $siswaModel = new SiswaModel();
        $data = $this->request->getPost();

        $siswaModel->update($id, [
            'id_periode'    => $data['id_periode'],
            'nama_siswa'    => $data['nama_siswa'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'tgl_lahir'     => $data['tgl_lahir'],
            'kelas'         => $data['kelas'],
            'juz'           => $data['juz'],
        ]);

        return redirect()->to('/data-siswa')->with('success', 'Data siswa berhasil diupdate');
    }

    public function delete($id)
    {
        $siswaModel = new SiswaModel();
        $siswaModel->delete($id);

        return redirect()->to('/data-siswa')->with('success', 'Data siswa berhasil dihapus');
    }
}
