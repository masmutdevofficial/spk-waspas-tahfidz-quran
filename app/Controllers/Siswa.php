<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\PeriodeModel;
use App\Models\UserModel;

class Siswa extends BaseController
{
    public function index(): string
    {
        $siswaModel   = new SiswaModel();
        $periodeModel = new PeriodeModel();
        $userModel    = new UserModel();

        // --- Ambil info user dari session -------------
        $session      = session();
        $loggedRole   = $session->get('role');   // 1 = Admin, 2 = Guru Penguji
        $loggedUserId = $session->get('id');     // id pada tabel users
        // ----------------------------------------------

        // --- Filter periode dari dropdown ------------
        $filterPeriode = $this->request->getGet('periode');
        // ----------------------------------------------

        // --- Query data siswa + info periode + guru ---
        $query = $siswaModel
            ->select('siswa.*, periode.tahun, periode.semester, users.nama AS nama_guru')
            ->join('periode', 'periode.id = siswa.id_periode')
            ->join('users',   'users.id   = siswa.id_user', 'left');

        // Filter berdasarkan periode (jika dipilih)
        if (!empty($filterPeriode)) {
            $query->where('siswa.id_periode', $filterPeriode);
        }

        // 🔒 Jika login sebagai Guru Penguji, batasi hanya siswa miliknya
        if ($loggedRole == 2) {
            $query->where('siswa.id_user', $loggedUserId);
        }

        // ----------------------------------------------
        $data['siswa']     = $query->findAll();
        $data['periode']   = $periodeModel->findAll();
        $data['filter_id'] = $filterPeriode;

        // Dropdown guru hanya diperlukan Admin.
        $data['guru'] = ($loggedRole == 1)
            ? $userModel->where('role', 2)->findAll()
            : [];  // kosongkan untuk guru agar dropdown tidak muncul

        return view('admin/data-siswa', $data);
    }

    public function tambah()
    {
        $siswaModel = new SiswaModel();
        $session = session();
        $data = $this->request->getPost();

        // Jika Guru Penguji, pakai ID dari session
        if ($session->get('role') == 2) {
            $data['id_user'] = $session->get('id');
        }

        $siswaModel->save([
            'id_periode'    => $data['id_periode'],
            'id_user'       => $data['id_user'],
            'nama_siswa'    => $data['nama_siswa'],
            'nis'           => $data['nis'],
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
        $session = session();
        $data = $this->request->getPost();

        if ($session->get('role') == 2) {
            $data['id_user'] = $session->get('id');
        }

        $siswaModel->update($id, [
            'id_periode'    => $data['id_periode'],
            'id_user'       => $data['id_user'],
            'nis'           => $data['nis'],
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
