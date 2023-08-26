<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdiModel;

class Prodi extends BaseController
{
    protected $prodiModel;

    function __construct(){
        $this->validation = \Config\Services::validation();
        $this->m_posts = new prodiModel();
        helper('global_fungsi_helper');
    }

    public function index()
    {
        $data = [];
        if ($this->request->getVar('aksi') == 'hapus' && $this->request->getVar('post_id')) {
            $dataPost = $this->m_posts->getPost($this->request->getVar('post_id'));
            if ($dataPost['post_id']) {
                @unlink(LOKASI_UPLOAD . "/" . $dataPost['post_thumbnail']);
                $aksi = $this->m_posts->deletePost($this->request->getVar('post_id'));
                if ($aksi == true) {
                    session()->setFlashdata('success', "Data Berhasil Dihapus");
                } else {
                    session()->setFlashdata('warning', ['Gagal Menghapus data']);
                }
            }
            return redirect()->to("admin/prodi");
        }

        $data['templateJudul'] = "Halaman Prodi";

        $jumlahBaris = 6;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $model = new ProdiModel();
        $hasil = $model->listProdi($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('admin/v_template_header', $data);
        echo view('admin/v_prodi', $data);
        echo view('admin/v_template_footer', $data);
    }

    function tambah()
    {
        $data = [];
    
        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
    
            $aturan = [
                'nama_prodi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nama_prodi harus diisi'
                    ],
                ],
                'gambar' => [
                    'rules' => 'is_image[gambar]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang diperbolehkan untuk diupload'
                    ]
                ]
            ];
    
            $file = $this->request->getFile('gambar');
    
            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $gambar = '';
                if ($file->getName()) {
                    $gambar = $file->getRandomName();
                }
    
                $record = [
                    'gambar' => $gambar,
                    'nama_prodi' => $this->request->getVar('nama_prodi'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                ];
    
                $model = new ProdiModel();
                $result = $model->insertProdi($record);
    
                if ($result) {
                    if ($file->getName()) {
                        $lokasi_direktori = LOKASI_UPLOAD;
                        $file->move($lokasi_direktori, $gambar);
                    }
                    session()->setFlashdata('success', 'Data prestasi berhasil ditambahkan');
                    return redirect()->to('admin/prodi/tambah');
                } else {
                    session()->setFlashdata('warning', 'Gagal menambahkan data prestasi');
                    return redirect()->to('admin/prodi/tambah');
                }
            }
        }

        $data['templateJudul'] = "Halaman Tambah Program Studi";
        
        echo view('admin/v_template_header', $data);
        echo view('admin/v_prodi_tambah', $data);
        echo view('admin/v_template_footer', $data);
    }

    function edit($id_prodi)
    {
        $data = [];
        $model = new ProdiModel();
        $dataProdi = $model->getProdi($id_prodi);

        if (empty($dataProdi)) {
            return redirect()->to('admin/prodi');
        }

        $data = $dataProdi;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();

            $aturan = [
                'nama_prodi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nama prodi harus diisi'
                    ],
                ],
                'gambar' => [
                    'rules' => 'is_image[gambar]',
                    'errors' => [
                        'is_image' => 'Hanya gambar yang diperbolehkan untuk diupload'
                    ]
                ]
            ];

            $file = $this->request->getFile('gambar');

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $gambar = '';
                if ($file->getName()) {
                    $gambar = $file->getRandomName();
                }

                $record = [
                    'gambar' => $gambar,
                    'nama_prodi' => $this->request->getVar('nama_prodi'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'id_prodi' => $id_prodi,
                ];

                $model = new ProdiModel();
                $result = $model->insertProdi($record);

                if ($result) {
                    if ($file->getName()) {
                        $lokasi_direktori = LOKASI_UPLOAD;
                        $file->move($lokasi_direktori, $gambar);
                    }
                    session()->setFlashdata('success', 'Data prestasi berhasil ditambahkan');
                    return redirect()->to('admin/prodi');
                } else {
                    session()->setFlashdata('warning', 'Gagal menambahkan data prestasi');
                    return redirect()->to('admin/prodi/tambah');
                }
            }
        }

        $data['templateJudul'] = "Halaman Edit Prestasi";

        echo view('admin/v_template_header', $data);
        echo view('admin/v_prodi_edit', $data);
        echo view('admin/v_template_footer', $data);
    }

    function delete($id_prodi)
    {
        $model = new ProdiModel();

        $result = $model->deleteProdi($id_prodi);
        if ($result) {
            session()->setFlashdata('success', 'Data prestasi berhasil dihapus.');
        } else {
            session()->setFlashdata('warning', 'Data prestasi gagal dihapus.');
        }

        return redirect()->to('/admin/prodi');
    }
}
