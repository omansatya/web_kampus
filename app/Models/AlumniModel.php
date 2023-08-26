<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumniModel extends Model
{
    protected $table = "alumni";
    protected $primaryKey = 'id_alumni';
    protected $allowedFields = ['gambar', 'nama_alumni', 'pekerjaan', 'deskripsi'];

    public function insertAlumni($data)
    {
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['id_alumni'])) {
            $aksi = $builder->save($data);
            $id = $data['id_alumni'];
        } else {
            $aksi = $builder->save($data);
            $id = $builder->getInsertID();
        }
        
        return $aksi ? $id : false;
    }

    public function listAlumni($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        $arr_katakunci = explode(' ', $katakunci);
        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('nama_alumni', $arr_katakunci[$x]);
            $builder->orLike('pekerjaan', $arr_katakunci[$x]);
            $builder->orLike('deskripsi', $arr_katakunci[$x]);
        }
        $builder->groupEnd();

        // Anda dapat mengganti kolom yang sesuai untuk mengurutkan data
        $builder->orderBy('nama_alumni', 'asc');

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    public function getAlumni($id_alumni)
    {
        $builder = $this->table($this->table);

        $builder->where('id_alumni', $id_alumni);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function deleteAlumni($id_alumni)
    {
        $builder = $this->table($this->table);
        $builder->where('id_alumni', $id_alumni);
        return $builder->delete();
    }

    public function updateAlumni($data, $id_alumni)
    {
        $this->where('id_alumni', $id_alumni);
        return $this->update($data);
    }
}
