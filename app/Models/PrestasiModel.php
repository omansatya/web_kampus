<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestasiModel extends Model
{
    protected $table = "prestasi";
    protected $primaryKey = 'id_prestasi';
    protected $allowedFields = ['gambar', 'title', 'lokasi', 'deskripsi', 'tanggal'];

    function insertPrestasi($data)
    {
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['id_prestasi'])) {
            $aksi = $builder->save($data);
            $id = $data['id_prestasi'];
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

    function listPrestasi($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        $arr_katakunci = explode(' ', $katakunci);
        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('title', $arr_katakunci[$x]);
            $builder->orLike('lokasi', $arr_katakunci[$x]);
            $builder->orLike('deskripsi', $arr_katakunci[$x]);
        }

        $builder->groupEnd();

        $builder->orderBy('tanggal', 'desc');

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    function getPrestasi($id_prestasi)
    {
        $builder = $this->table($this->table);

        $builder->where('id_prestasi', $id_prestasi);
        $query = $builder->get();
        return $query->getRowArray();
    }

    function deletePrestasi($id_prestasi)
    {
        $builder = $this->table($this->table);
        $builder->where('id_prestasi', $id_prestasi);
        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }

    function updatePrestasi($data, $id_prestasi)
    {
        $this->where('id_prestasi', $id_prestasi);
        return $this->update($data);
    }
}
