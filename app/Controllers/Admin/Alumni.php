<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AlumniModel;

class Alumni extends BaseController
{
    protected $alumniModel;

    function __construct(){
        $this->validation = \Config\Services::validation();
        $this->m_post = new AlumniModel();
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

        $data['templateJudul'] = "Halaman Alumni";

        $jumlahBaris = 6;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $model = new AlumniModel();
        $hasil = $model->listAlumni($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('admin/v_template_header', $data);
        echo view('admin/v_alumni', $data);
        echo view('admin/v_template_footer', $data);
    }

    public function tambah()
    {
        $data = [];
    
        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
    
            $aturan = [
                'nama_alumni' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nama_alumni harus diisi'
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
                    'nama_alumni' => $this->request->getVar('nama_alumni'),
                    'pekerjaan' => $this->request->getVar('pekerjaan'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                ];
    
                $model = new AlumniModel();
                $result = $model->insertAlumni($record);
    
                if ($result) {
                    if ($file->getName()) {
                        $lokasi_direktori = LOKASI_UPLOAD;
                        $file->move($lokasi_direktori, $gambar);
                    }
                    session()->setFlashdata('success', 'Data prestasi berhasil ditambahkan');
                    return redirect()->to('admin/alumni');
                } else {
                    session()->setFlashdata('warning', 'Gagal menambahkan data prestasi');
                    return redirect()->to('admin/alumni/tambah');
                }
            }
        }

        $data['templateJudul'] = "Halaman Tambah Alumni";
        
        echo view('admin/v_template_header', $data);
        echo view('admin/v_alumni_tambah', $data);
        echo view('admin/v_template_footer', $data);
    }

    function edit($id_alumni)
    {
        $data = [];
        $model = new AlumniModel();
        $dataAlumni = $model->getAlumni($id_alumni);

        if (empty($dataAlumni)) {
            return redirect()->to('admin/alumni');
        }

        $data = $dataAlumni;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();

            $aturan = [
                'nama_alumni' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nama alumni harus diisi'
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
                    'nama_alumni' => $this->request->getVar('nama_alumni'),
                    'pekerjaan' => $this->request->getVar('pekerjaan'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'id_alumni' => $id_alumni,
                ];

                $model = new AlumniModel();
                $result = $model->insertalumni($record);

                if ($result) {
                    if ($file->getName()) {
                        $lokasi_direktori = LOKASI_UPLOAD;
                        $file->move($lokasi_direktori, $gambar);
                    }
                    session()->setFlashdata('success', 'Data prestasi berhasil ditambahkan');
                    return redirect()->to('admin/alumni');
                } else {
                    session()->setFlashdata('warning', 'Gagal menambahkan data prestasi');
                    return redirect()->to('admin/alumni/tambah');
                }
            }
        }

        $data['templateJudul'] = "Halaman Edit alumni";

        echo view('admin/v_template_header', $data);
        echo view('admin/v_alumni_edit', $data);
        echo view('admin/v_template_footer', $data);
    }

    function delete($id_alumni)
    {
        $model = new AlumniModel();

        $result = $model->deleteAlumni($id_alumni);
        if ($result) {
            session()->setFlashdata('success', 'Data prestasi berhasil dihapus.');
        } else {
            session()->setFlashdata('warning', 'Data prestasi gagal dihapus.');
        }

        return redirect()->to('/admin/alumni');
    }
}
