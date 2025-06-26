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

        $model->save([
            'nama_kriteria' => $data['nama_kriteria'],
            'jenis'         => $data['jenis'],
            'bobot'         => $data['bobot'],
        ]);

        return redirect()->to('/data-kriteria')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        $model = new KriteriaModel();
        $data = $this->request->getPost();

        $model->update($id, [
            'nama_kriteria' => $data['nama_kriteria'],
            'jenis'         => $data['jenis'],
            'bobot'         => $data['bobot'],
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
