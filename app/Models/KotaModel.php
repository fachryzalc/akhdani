<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $table = 'kota';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'nama', 'longitude', 'latitude', 'provinsi', 'pulau', 'luar'];

    public function getKota($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function dataKota($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->findAll();
    }
}
