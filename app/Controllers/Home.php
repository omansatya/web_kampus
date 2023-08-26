<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AlumniModel;
use App\Models\GaleriModel;
use App\Models\PrestasiModel;
use App\Models\ProdiModel;


class Home extends BaseController
{
    public function index()
    {
        $data = [];

        $prestasiModel = new PrestasiModel();
        $prodiModel = new ProdiModel();
        $galeriModel = new GaleriModel();
        $alumniModel = new AlumniModel();

        $data['prestasi'] = $prestasiModel->findAll();
        $data['prodi'] = $prodiModel->findAll();
        $data['alumni'] = $alumniModel->findAll();
        $data['galeri'] = $galeriModel->findAll();


        echo view("depan/v_home_header", $data);
        echo view("depan/v_home", $data);
        echo view("depan/v_home_footer", $data);
        
    }
}
