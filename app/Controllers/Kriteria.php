<?php

namespace App\Controllers;

use App\Models\KriteriaModel;

class Kriteria extends BaseController
{
    public function index(): string
    {
        $model = new KriteriaModel();
        $data['kriteria'] = $model->findAll();
        return view('admin/data-kriteria', $data);
    }

    public function tambah()
    {
        $model = new KriteriaModel();
        $data = $this->request->getPost();

        // Hitung total bobot yang sudah ada
        $totalBobot = $model->selectSum('bobot')->first()['bobot'];
        $bobotBaru  = floatval($data['bobot']);
        $totalBaru  = $totalBobot + $bobotBaru;

        if ($totalBaru > 1) {
            return redirect()->to('/data-kriteria')->with('error', 'Maksimal Bobot 1');
        }

        // Simpan jika valid
        $model->save([
            'nama_kriteria' => $data['nama_kriteria'],
            'jenis'         => $data['jenis'],
            'bobot'         => $bobotBaru,
        ]);

        return redirect()->to('/data-kriteria')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        $model = new KriteriaModel();
        $data = $this->request->getPost();
        $bobotBaru = floatval($data['bobot']);

        // Hitung total bobot selain kriteria yang sedang di-update
        $totalBobotLain = $model->selectSum('bobot')
                                ->where('id !=', $id)
                                ->first()['bobot'];

        $totalSetelahUpdate = $totalBobotLain + $bobotBaru;

        if ($totalSetelahUpdate > 1) {
            return redirect()->to('/data-kriteria')->with('error', 'Maksimal Bobot Bernilai 1');
        }

        // Simpan update
        $model->update($id, [
            'nama_kriteria' => $data['nama_kriteria'],
            'jenis'         => $data['jenis'],
            'bobot'         => $bobotBaru,
        ]);

        return redirect()->to('/data-kriteria')->with('success', 'Data berhasil diupdate');
    }
    public function delete($id)
    {
        $model = new KriteriaModel();
        $model->delete($id);

        return redirect()->to('/data-kriteria')->with('success', 'Data berhasil dihapus');
    }
}
