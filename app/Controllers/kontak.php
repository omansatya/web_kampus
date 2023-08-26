<?php namespace App\Controllers;

class kontak extends BaseController
{
    public function index()
    {
        $data = [];

        echo view("depan/v_home_header", $data);
        echo view("depan/v_contact", $data);
        echo view("depan/v_home_footer", $data);
    }
}
