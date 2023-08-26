<?php namespace App\Controllers;

class profil extends BaseController
{
    public function index()
    {
        $data = [];

        echo view("depan/v_home_header", $data);
        echo view("depan/v_profil", $data);
        echo view("depan/v_home_footer", $data);
    }
}
