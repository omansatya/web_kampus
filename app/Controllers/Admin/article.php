<?php
namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Article extends BaseController{
    
    function __construct(){
        $this->validation = \Config\Services::validation();
        $this->m_posts = new PostModel();
        helper('global_fungsi_helper');
    }

    function index(){
        $data = [];
        $data['templateJudul'] = "Halaman admin";
        // header
        echo view('admin/v_template_header', $data);
        // main
        echo view('admin/v_article', $data);
        // footer
        echo view('admin/v_template_footer', $data);
    }

    
}