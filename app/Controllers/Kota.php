<?php

namespace App\Controllers;

use App\Models\KotaModel;

class Kota extends BaseController
{
    protected $kotaModel;

    public function __construct()
    {
        $this->kotaModel = new KotaModel();
    }

    public function index()
    {
        $dataKota = $this->kotaModel->getKota();
        $data = [
            'title' => 'Master Kota',
            'sidebar' => 'kota',
            'dataKota' => $dataKota
        ];
        return view('kota/kota', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Kota',
            'sidebar' => 'kota',
            'validation' => \Config\Services::validation()
        ];
        return view('kota/tambah', $data);
    }

    public function simpan()
    {

        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|max_length[150]|is_unique[kota.nama]',
                'errors' => [
                    'required' => 'Nama Kota Belum Diisi.',
                    'max_length' => 'Nama Kota Terlalu Panjang (Max. 150).',
                    'is_unique' => 'Nama Kota Sudah Terdaftar'
                ]
            ],
            'provinsi' => [
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Nama Provinsi Belum Diisi.',
                    'max_length' => 'Nama Provinsi Terlalu Panjang (Max. 150).'
                ]
            ],
            'pulau' => [
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Nama Pulau Belum Diisi.',
                    'max_length' => 'Nama Pulau Terlalu Panjang (Max. 150).'
                ]
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Longitude Belum Diisi.'
                ]
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Latitude Belum Diisi.'
                ]
            ]
        ])) {
            return redirect()->to('/kota/tambah')->withInput()->with('validation', $validation);
        }

        $this->kotaModel->save([
            'nama' => $this->request->getVar('nama'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'provinsi' => $this->request->getVar('provinsi'),
            'pulau' => $this->request->getVar('pulau'),
            'luar' => ($this->request->getVar('luar')) ? '1' : '0'
        ]);

        session()->setFlashdata('title', 'Sukses');
        session()->setFlashdata('text', 'Berhasil menambah data kota');

        return redirect()->to('kota');
    }


    public function hapus($id)
    {
        $this->kotaModel->delete($id);
        session()->setFlashdata('title', 'Sukses');
        session()->setFlashdata('text', 'Berhasil menghapus data kota');
        return redirect()->to('kota');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Data Kota',
            'sidebar' => 'kota',
            'validation' => \Config\Services::validation(),
            'dataKota' => $this->kotaModel->getKota($id),
        ];
        return view('kota/edit', $data);
    }

    public function update($id)
    {
        $dataKota = $this->kotaModel->getKota($id);
        if ($dataKota['nama'] == $this->request->getVar('nama')) {
            $rules_nama = 'required|max_length[150]';
        } else {
            $rules_nama = 'required|max_length[150]|is_unique[kota.nama]';
        }
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nama' => [
                'rules' => $rules_nama,
                'errors' => [
                    'required' => 'Nama Kota Belum Diisi.',
                    'max_length' => 'Nama Kota Terlalu Panjang (Max. 150).',
                    'is_unique' => 'Nama Kota Sudah Terdaftar'
                ]
            ],
            'provinsi' => [
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Nama Provinsi Belum Diisi.',
                    'max_length' => 'Nama Provinsi Terlalu Panjang (Max. 150).'
                ]
            ],
            'pulau' => [
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Nama Pulau Belum Diisi.',
                    'max_length' => 'Nama Pulau Terlalu Panjang (Max. 150).'
                ]
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Longitude Belum Diisi.'
                ]
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Latitude Belum Diisi.'
                ]
            ]
        ])) {
            return redirect()->to('/kota/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $this->kotaModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'provinsi' => $this->request->getVar('provinsi'),
            'pulau' => $this->request->getVar('pulau'),
            'luar' => ($this->request->getVar('luar')) ? '1' : '0'
        ]);

        session()->setFlashdata('title', 'Sukses');
        session()->setFlashdata('text', 'Berhasil menambah data kota');

        return redirect()->to('kota');
    }
}
