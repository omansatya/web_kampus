<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = "galeri";
    protected $primaryKey = 'id_galeri';
    protected $allowedFields = ['gambar', 'nama_kegiatan'];

    public function insertGaleri($data)
    {
        $builder = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purify($value);
        }

        if (isset($data['id_galeri'])) {
            $aksi = $builder->save($data);
            $id = $data['id_galeri'];
        } else {
            $aksi = $builder->save($data);
            $id = $builder->getInsertID();
        }
        
        return $aksi ? $id : false;
    }

    public function listGaleri($jumlahBaris, $katakunci = null, $group_dataset = null)
    {
        $builder = $this->table($this->table);

        $arr_katakunci = explode(' ', $katakunci);
        $builder->groupStart();
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('nama_kegiatan', $arr_katakunci[$x]);
        }
        $builder->groupEnd();

        // Anda dapat mengganti kolom yang sesuai untuk mengurutkan data
        $builder->orderBy('nama_kegiatan', 'asc');

        $data['record'] = $builder->paginate($jumlahBaris, $group_dataset);
        $data['pager'] = $builder->pager;

        return $data;
    }

    public function getGaleri($id_galeri)
    {
        $builder = $this->table($this->table);

        $builder->where('id_galeri', $id_galeri);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function deleteGaleri($id_galeri)
    {
        $builder = $this->table($this->table);
        $builder->where('id_galeri', $id_galeri);
        return $builder->delete();
    }

    public function updateGaleri($data, $id_galeri)
    {
        $this->where('id_galeri', $id_galeri);
        return $this->update($data);
    }
}
