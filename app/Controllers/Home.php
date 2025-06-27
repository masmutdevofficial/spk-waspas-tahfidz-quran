<?php

namespace App\Controllers;

use App\Models\HasilPenilaianModel;
use App\Models\KriteriaModel;
use App\Models\NilaiSiswaModel;
use App\Models\SiswaModel;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        return view('login');
    }

    public function proses()
    {
        $users = new UserModel();
        $session = session();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        // Cari user berdasarkan email
        $user = $users->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }

        // Cek password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah.');
        }

        // Cek role
        if ((int)$user['role'] !== (int)$role) {
            return redirect()->back()->with('error', 'Peran tidak sesuai.');
        }

        // Set session
        $session->set([
            'id'     => $user['id'],
            'nama'   => $user['nama'],
            'email'  => $user['email'],
            'role'   => $user['role'],
            'logged_in' => true,
        ]);

        // Arahkan ke dashboard setelah berhasil
        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy(); // Hapus semua session
        return redirect()->to('/login')->with('success', 'Berhasil logout');
    }

    public function hasil()
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

        return view('hasil-penilaian', compact('siswaData'));
    }
}
