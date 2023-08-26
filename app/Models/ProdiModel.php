<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $table = "prodi";
    protected $primaryKey = 'id_prodi';
    protected $allowedFields = ['gambar', 'nama_prodi', 'deskripsi'];

    function insertProdi($data)
    {
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['id_prodi'])) {
            $aksi = $builder->save($data);
            $id = $data['id_prodi'];
        } else {
            $aksi = $builder->save($data);
            $id = $builder->getInsertID();
        }
        if ($aksi) {
            return $id;
        } else {
            return false;
        }
    }

    function listProdi($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        $arr_katakunci = explode(' ', $katakunci);
        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('nama_prodi', $arr_katakunci[$x]);
            $builder->orLike('deskripsi', $arr_katakunci[$x]);
        }

        $builder->groupEnd();

        // Anda dapat mengganti kolom yang sesuai untuk mengurutkan data
        $builder->orderBy('nama_prodi', 'asc');

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    function getProdi($id_prodi)
    {
        $builder = $this->table($this->table);

        $builder->where('id_prodi', $id_prodi);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function deleteProdi($id_prodi)
    {
        $builder = $this->table($this->table);
        $builder->where('id_prodi', $id_prodi);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }

    function updateProdi($data, $id_prodi)
    {
        $this->where('id_prodi', $id_prodi);
        return $this->update($data);
    }
}
