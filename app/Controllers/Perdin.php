<?php

namespace App\Controllers;

use App\Models\PerdinModel;
use App\Models\KotaModel;
use App\Models\UserModel;

class Perdin extends BaseController
{
    protected $perdinModel;
    protected $kotaModel;
    protected $userModel;

    public function __construct()
    {
        $this->perdinModel = new PerdinModel();
        $this->kotaModel = new KotaModel();
        $this->userModel = new UserModel();
    }

    public function pegawai($id)
    {
        $dataPerdin = $this->perdinModel->dataperdinPegawai($id);

        $data = [
            'title' => 'PerdinKu',
            'sidebar' => 'perdinku',
            'dataPerdin' => $dataPerdin
        ];
        return view('perdin/pegawai', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Ajukan PerdinKu',
            'sidebar' => 'perdinku',
            'validation' => \Config\Services::validation(),
            'dataKota' => $this->kotaModel->getKota()
        ];
        return view('perdin/tambah', $data);
    }

    public function jarak($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $km = ($dist * 60 * 1.1515) * 1.609344;
        return (intval($km));
    }

    public function simpan()
    {
        $id_user = $this->request->getVar('id_user');
        $lama = $this->request->getVar('lama');

        $dataUser = $this->userModel->getUser($id_user);
        $asal = $this->kotaModel->getKota($this->request->getVar('asal'));
        $tujuan = $this->kotaModel->getKota($this->request->getVar('tujuan'));
        $jarak = $this->jarak($asal['latitude'], $asal['longitude'], $tujuan['latitude'], $tujuan['longitude']);

        if ($tujuan['luar'] == 1) {
            $saku = [
                'total' => $lama * 50,
                'matauang' => '$ '
            ];
        } else {
            if ($jarak <= 60) {
                $saku = [
                    'total' => 0,
                    'matauang' => 'Rp. '
                ];
            } else {
                if ($jarak >= 60 && $asal['provinsi'] == $tujuan['provinsi']) {
                    dd($asal['provinsi'] == $tujuan['provinsi']);
                    $saku = [
                        'total' => (int)200000 * (int)$lama,
                        'matauang' => 'Rp. '
                    ];
                } else {
                    if ($jarak >= 60 && $asal['provinsi'] != $tujuan['provinsi'] && $asal['pulau'] == $tujuan['pulau']) {
                        $saku = [
                            'total' => (int)250000 * (int)$lama,
                            'matauang' => 'Rp. '
                        ];
                    } else {
                        $saku = [
                            'total' => (int)300000 * (int)$lama,
                            'matauang' => 'Rp. '
                        ];
                    }
                }
            }
        }

        $validation = \Config\Services::validation();
        if (!$this->validate([
            'asal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kota Asal Belum Diisi'
                ]
            ],
            'tujuan' => [
                'required',
                'errors' => [
                    'required' => 'Kota Tujuan Belum Diisi'
                ]
            ],
            'berangkat' => [
                'required',
                'errors' => [
                    'required' => 'Tanggal Berangkat Belum Diisi'
                ]
            ],
            'pulang' => [
                'required',
                'errors' => [
                    'required' => 'Tanggal Pulang Belum Diisi'
                ]
            ],
            'keterangan' => [
                'required',
                'errors' => [
                    'required' => 'Keterangan Belum Diisi'
                ]
            ]
        ])) {
            return redirect()->to('perdin/tambah')->withInput()->with('validation', $validation);
        }

        $this->perdinModel->save([
            'id_user' => $dataUser['id'],
            'nama' => $dataUser['nama'],
            'asal' => $asal['nama'],
            'tujuan' => $tujuan['nama'],
            'berangkat' => $this->request->getVar('berangkat'),
            'pulang' => $this->request->getVar('pulang'),
            'keterangan' => $this->request->getVar('keterangan'),
            'jarak' => $jarak,
            'saku' => $saku['matauang'] . $saku['total'],
            'lama' => $lama,
            'status' => 2
        ]);

        session()->setFlashdata('title', 'Sukses');
        session()->setFlashdata('text', 'Berhasil Mengajukan Perjalanan Dinas');

        return redirect()->to(site_url('perdin/pegawai/' . $dataUser['id']));
    }



    // SDM

    public function sdm()
    {
        $dataPerdin = $this->perdinModel->dataperdinApprove(2);

        $data = [
            'title' => 'Pengajuan Baru PerdinKu',
            'sidebar' => 'baru',
            'dataPerdin' => $dataPerdin,
            'badge' => count($dataPerdin)
        ];
        return view('perdin/sdm', $data);
    }

    public function detail($id)
    {
        $dataPerdin = $this->perdinModel->getPerdin($id);

        $data = [
            'title' => 'Detail PerdinKu',
            'sidebar' => 'baru',
            'dataPerdin' => $dataPerdin,
            'badge' => count($this->perdinModel->dataperdinApprove(2))
        ];

        return view('perdin/detail', $data);
    }

    public function approve($id)
    {
        $dataPerdins = $this->perdinModel->getPerdin();
        $dataPerdin = $this->perdinModel->getPerdin($id);
        $data = [
            'title' => 'Pengajuan Baru PerdinKu',
            'sidebar' => 'baru',
            'dataPerdin' => $dataPerdins,
            'badge' => count($this->perdinModel->dataperdinApprove(2))
        ];
        $this->perdinModel->save([
            'id' => $id,
            'status' => 1
        ]);

        session()->setFlashdata('title', 'Sukses');
        session()->setFlashdata('text', 'Berhasil Approve Perjalanan Dinas' . $dataPerdin['nama']);
        return redirect('perdin/sdm', $data);
    }

    public function reject($id)
    {
        $dataPerdins = $this->perdinModel->getPerdin();
        $dataPerdin = $this->perdinModel->getPerdin($id);
        $data = [
            'title' => 'Pengajuan Baru PerdinKu',
            'sidebar' => 'baru',
            'dataPerdin' => $dataPerdins,
            'badge' => count($this->perdinModel->dataperdinApprove(2))
        ];
        $this->perdinModel->save([
            'id' => $id,
            'status' => 0
        ]);

        session()->setFlashdata('title', 'Sukses');
        session()->setFlashdata('text', 'Berhasil Reject Perjalanan Dinas' . $dataPerdin['nama']);
        return redirect('perdin/sdm', $data);
    }

    public function history()
    {
        $data = [
            'title' => 'History Pengajuan PerdinKu',
            'sidebar' => 'history',
            'dataPerdin' => $this->perdinModel->dataperdinHistory(),
            'badge' => count($this->perdinModel->dataperdinApprove(2))
        ];
        return view('perdin/history', $data);
    }
}
