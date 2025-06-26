<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        return view('admin/data-user', $data);
    }

    public function tambah()
    {
        $userModel = new \App\Models\UserModel();
        $data = $this->request->getPost();

        $userModel->save([
            'nama'     => $data['nama'],
            'email'    => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role'     => $data['role'],
        ]);

        return redirect()->to('/data-user')->with('success', 'User berhasil ditambahkan');
    }


    public function update($id)
    {
        $userModel = new UserModel();
        $data = $this->request->getPost();

        $userModel->update($id, [
            'nama'  => $data['nama'],
            'email' => $data['email'],
            'role'  => $data['role']
        ]);

        return redirect()->to('/data-user')->with('success', 'User berhasil diupdate');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/data-user')->with('success', 'User berhasil dihapus');
    }
}
