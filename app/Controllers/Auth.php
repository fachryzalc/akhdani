<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Home',
            'sidebar' => 'home'
        ];
        return view('home', $data);
    }

    public function login()
    {
        if (session('id')) {
            return redirect()->to(site_url("/"));
        }
        $data = [
            'title' => 'Login'
        ];
        return view('login', $data);
    }

    public function prosesLogin()
    {
        $post = $this->request->getPost();
        $user = $this->userModel->dataUsername($post['username']);
        $user = $user[0];

        if ($user) {
            if ($post['password'] == $user['password']) {
                $params = [
                    "id" => $user['id'],
                    "username" => $user['username'],
                    "akses" => $user['akses'],
                    "nama" => $user['nama']
                ];

                session()->set($params);
                if ($user['akses'] == 1) {
                    return redirect()->to(site_url('kota'));
                } elseif ($user['akses'] == 2) {
                    return redirect()->to(site_url('/perdin/sdm'));
                } elseif ($user['akses'] == 3) {
                    return redirect()->to(site_url('/perdin/pegawai/' . $user['id']));
                } else {
                    return redirect('/auth/login')->withInput();
                }
            } else {
                session()->setFlashdata('password', 'Password Salah');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata("username", "Masukkan username yang sesuai");
            session()->setFlashdata("password", "Masukkan password");

            return redirect()->back()->withInput();
        }
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
            'validation' => \Config\Services::validation()
        ];
        return view('register', $data);
    }

    public function prosesRegister()
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
                    'required' => 'Password belum diisi',
                    'matches' => 'Password tidak sama'
                ]
            ]
        ])) {
            return redirect()->to('auth/register')->withInput()->with('validation', $validation);
        }

        $this->userModel->save([
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'akses' => 3
        ]);

        session()->setFlashdata('title', 'Sukses');
        session()->setFlashdata('text', 'Berhasil register');

        return redirect()->to('auth/login');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url("/"));
    }
}
