<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data User',
            'sidebar' => 'user',
            'dataUser' => $this->userModel->getUser()
        ];
        return view('user/user', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah User',
            'sidebar' => 'user',
            'validation' => \Config\Services::validation()
        ];
        return view('user/tambah', $data);
    }

    public function simpan()
    {
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Nama Belum Diisi.',
                    'max_length' => 'Nama Terlalu Panjang (Max. 150).'
                ]
            ],
            'username' => [
                'rules' => 'required|max_length[50]|is_unique[user.username]',
                'errors' => [
                    'required' => 'Username belum diisi',
                    'max_length' => 'Username terlalu panjang (Max. 50).',
                    'is_unique' => 'Username Sudah Terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Password belum diisi',
                    'max_length' => 'Password terlalu panjang (Max. 50).'
                ]
            ],
            'passwordv' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi Password belum diisi',
                    'matches' => 'Password tidak sama'
                ]
            ]
        ])) {
            return redirect()->to('user/tambah')->withInput()->with('validation', $validation);
        }

        $this->userModel->save([
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'akses' => 1
        ]);

        session()->setFlashdata('title', 'Sukses');
        session()->setFlashdata('text', 'Berhasil menambah admin baru');

        return redirect()->to('user');
    }

    public function hapus($id)
    {
        $this->userModel->delete($id);
        session()->setFlashdata('title', 'Sukses');
        session()->setFlashdata('text', 'Berhasil menghapus user');
        return redirect()->to('user');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Data User',
            'sidebar' => 'user',
            'validation' => \Config\Services::validation(),
            'dataUser' => $this->userModel->getUser($id),
        ];
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $dataUser = $this->userModel->getUser($id);
        $oldUsername = $this->request->getVar('username');

        if ($dataUser['username'] == $oldUsername) {
            $rules_username = 'required|max_length[150]';
        } else {
            $rules_username = 'required|max_length[150]|is_unique[user.username]';
        }
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Nama Belum Diisi.',
                    'max_length' => 'Nama Terlalu Panjang (Max. 150).'
                ]
            ],
            'username' => [
                'rules' => $rules_username,
                'errors' => [
                    'required' => 'Username belum diisi',
                    'max_length' => 'Username terlalu panjang (Max. 50).',
                    'is_unique' => 'Username Sudah Terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/user/edit/' . $id)->withInput()->with('validation', $validation);
        }
        $this->userModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'akses' => $this->request->getVar('akses')
        ]);

        session()->setFlashdata('title', 'Sukses');
        session()->setFlashdata('text', 'Berhasil merubah data user');

        return redirect()->to('user');
    }
}
