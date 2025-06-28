<?php

namespace App\Controllers;

use App\Models\PeriodeModel;

class Periode extends BaseController
{
    public function index(): string
    {
        $model = new PeriodeModel();
        $data['periode'] = $model->findAll();
        return view('admin/data-periode', $data); // Pastikan file view ini tersedia
    }

    public function tambah()
    {
        $model = new PeriodeModel();
        $data = $this->request->getPost();

        $model->save([
            'tahun'    => $data['tahun'],
            'semester' => $data['semester'],
        ]);

        return redirect()->to('/data-periode')->with('success', 'Data periode berhasil ditambahkan');
    }

    public function update($id)
    {
        $model = new PeriodeModel();
        $data = $this->request->getPost();

        $model->update($id, [
            'tahun'    => $data['tahun'],
            'semester' => $data['semester'],
        ]);

        return redirect()->to('/data-periode')->with('success', 'Data periode berhasil diupdate');
    }

    public function delete($id)
    {
        $model = new PeriodeModel();
        $model->delete($id);

        return redirect()->to('/data-periode')->with('success', 'Data periode berhasil dihapus');
    }
}
