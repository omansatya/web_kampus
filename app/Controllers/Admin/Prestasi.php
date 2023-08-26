<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PrestasiModel;

class Prestasi extends BaseController
{
    function __construct(){
        $this->validation = \Config\Services::validation();
        $this->m_posts = new prestasiModel();
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
            return redirect()->to("admin/prestasi");
        }

        $data['templateJudul'] = "Halaman Prestasi";

        $jumlahBaris = 6;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $model = new PrestasiModel();
        $hasil = $model->listPrestasi($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        // header
        echo view('admin/v_template_header', $data);
        // main
        echo view('admin/v_prestasi', $data);
        // footer
        echo view('admin/v_template_footer', $data);
    }

    

    public function tambah()
    {
        $data = [];
    
        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
    
            $aturan = [
                'title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul harus diisi'
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
                    'title' => $this->request->getVar('title'),
                    'lokasi' => $this->request->getVar('lokasi'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'tanggal' => $this->request->getVar('tanggal'),
                ];
    
                $model = new PrestasiModel();
                $result = $model->insertPrestasi($record);
    
                if ($result) {
                    if ($file->getName()) {
                        $lokasi_direktori = LOKASI_UPLOAD;
                        $file->move($lokasi_direktori, $gambar);
                    }
                    session()->setFlashdata('success', 'Data prestasi berhasil ditambahkan');
                    return redirect()->to('admin/prestasi/tambah');
                } else {
                    session()->setFlashdata('warning', 'Gagal menambahkan data prestasi');
                    return redirect()->to('admin/prestasi/tambah');
                }
            }
        }
    
        $data['templateJudul'] = "Halaman Tambah Prestasi";
        echo view('admin/v_template_header', $data);
        // main
        echo view('admin/v_prestasi_tambah', $data);
        // footer
        echo view('admin/v_template_footer', $data);
    }
    

    public function simpan()
    {
        $model = new PrestasiModel();

        $data = [
            'gambar' => $this->request->getVar('gambar'),
            'title' => $this->request->getVar('title'),
            'lokasi' => $this->request->getVar('lokasi'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tanggal' => $this->request->getVar('tanggal'),
        ];

        $result = $model->insertPrestasi($data);
        if ($result) {
            session()->setFlashdata('success', 'Data prestasi berhasil ditambahkan.');
            return redirect()->to('/admin/prestasi');
        } else {
            session()->setFlashdata('warning', 'Data prestasi gagal ditambahkan.');
            return redirect()->back()->withInput();
        }
    }

    function edit($id_prestasi)
{
    $data = [];
    $model = new PrestasiModel();
    $dataPrestasi = $model->getPrestasi($id_prestasi);

    if (empty($dataPrestasi)) {
        return redirect()->to('admin/prestasi');
    }

    $data = $dataPrestasi;

    if ($this->request->getMethod() == 'post') {
        $data = $this->request->getVar();

        $aturan = [
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul harus diisi'
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
                'title' => $this->request->getVar('title'),
                'lokasi' => $this->request->getVar('lokasi'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'tanggal' => $this->request->getVar('tanggal'),
                'id_prestasi' => $id_prestasi
            ];

            $model = new PrestasiModel();
            $result = $model->insertPrestasi($record);

            if ($result) {
                if ($file->getName()) {
                    $lokasi_direktori = LOKASI_UPLOAD;
                    $file->move($lokasi_direktori, $gambar);
                }
                session()->setFlashdata('success', 'Data prestasi berhasil ditambahkan');
                return redirect()->to('admin/prestasi/tambah');
            } else {
                session()->setFlashdata('warning', 'Gagal menambahkan data prestasi');
                return redirect()->to('admin/prestasi/tambah');
            }
        }
    }

    $data['templateJudul'] = "Halaman Edit Prestasi";
    // header
    echo view('admin/v_template_header', $data);
    // main
    echo view('admin/v_prestasi_edit', $data);
    // footer
    echo view('admin/v_template_footer', $data);
}



    public function update()
    {
        $model = new PrestasiModel();

        $id_prestasi = $this->request->getVar('id_prestasi');
        $data = [
            'gambar' => $this->request->getVar('gambar'),
            'title' => $this->request->getVar('title'),
            'lokasi' => $this->request->getVar('lokasi'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tanggal' => $this->request->getVar('tanggal'),
        ];

        $result = $model->insertPrestasi($data, $id_prestasi);
        if ($result) {
            session()->setFlashdata('success', 'Data prestasi berhasil diperbarui.');
            return redirect()->to('/admin/prestasi');
        } else {
            session()->setFlashdata('warning', 'Data prestasi gagal diperbarui.');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id_prestasi)
    {
        $model = new PrestasiModel();

        $result = $model->deletePrestasi($id_prestasi);
        if ($result) {
            session()->setFlashdata('success', 'Data prestasi berhasil dihapus.');
        } else {
            session()->setFlashdata('warning', 'Data prestasi gagal dihapus.');
        }

        return redirect()->to('/admin/prestasi');
    }
}
