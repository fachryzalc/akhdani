<?php

namespace App\Models;

use CodeIgniter\Model;

class PerdinModel extends Model
{
    protected $table = 'perdin';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'id_user', 'asal', 'tujuan', 'berangkat', 'pulang', 'keterangan', 'status', 'jarak', 'saku', 'lama', 'nama'];

    public function getPerdin($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function dataPerdin($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->findAll();
    }

    public function dataperdinPegawai($id)
    {
        return $this->where(['id_user' => $id])->findAll();
    }

    public function dataperdinApprove($status)
    {
        return $this->where(['status' => $status])->findAll();
    }

    public function dataperdinHistory()
    {
        $status = "status = 0 OR status = 1";
        return $this->where($status)->findAll();
    }
}
