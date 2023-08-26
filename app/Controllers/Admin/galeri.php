<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleriModel;

class Galeri extends BaseController
{
    protected $galeriModel;

    function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->galeriModel = new GaleriModel();
        helper('global_fungsi_helper');
    }

    public function index()
    {
        $data = [];

        if ($this->request->getVar('aksi') == 'hapus' && $this->request->getVar('post_id')) {
            $dataGaleri = $this->galeriModel->getGaleri($this->request->getVar('post_id'));

            if ($dataGaleri['id_galeri']) {
                @unlink(LOKASI_UPLOAD . "/" . $dataGaleri['gambar']);
                $aksi = $this->galeriModel->deleteGaleri($this->request->getVar('post_id'));

                if ($aksi == true) {
                    session()->setFlashdata('success', "Data Berhasil Dihapus");
                } else {
                    session()->setFlashdata('warning', ['Gagal Menghapus data']);
                }
            }

            return redirect()->to("admin/galeri");
        }

        $data['templateJudul'] = "Halaman Galeri";

        $jumlahBaris = 6;
        $katakunci = $this->request->getVar('katakunci');
        $group_dataset = "dt";

        $hasil = $this->galeriModel->listGaleri($jumlahBaris, $katakunci, $group_dataset);

        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $data['katakunci'] = $katakunci;

        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);

        echo view('admin/v_template_header', $data);
        echo view('admin/v_galeri', $data);
        echo view('admin/v_template_footer', $data);
    }

    public function tambah()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();

            $aturan = [
                'nama_kegiatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama kegiatan harus diisi'
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
                    $lokasi_direktori = LOKASI_UPLOAD;
                    $file->move($lokasi_direktori, $gambar);
                }

                $record = [
                    'gambar' => $gambar,
                    'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
                ];

                $result = $this->galeriModel->insertGaleri($record);

                if ($result) {
                    session()->setFlashdata('success', 'Data galeri berhasil ditambahkan');
                    return redirect()->to('admin/galeri');
                } else {
                    session()->setFlashdata('warning', 'Gagal menambahkan data galeri');
                    return redirect()->to('admin/galeri/tambah');
                }
            }
        }

        $data['templateJudul'] = "Halaman Tambah Galeri";

        echo view('admin/v_template_header', $data);
        echo view('admin/v_galeri_tambah', $data);
        echo view('admin/v_template_footer', $data);
    }

    public function edit($id_galeri)
    {
        $data = [];
        $dataGaleri = $this->galeriModel->getGaleri($id_galeri);

        if (empty($dataGaleri)) {
            return redirect()->to('admin/galeri');
        }

        $data = $dataGaleri;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();

            $aturan = [
                'nama_kegiatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama kegiatan harus diisi'
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
                $gambar = $dataGaleri['gambar'];
                if ($file->getName()) {
                    @unlink(LOKASI_UPLOAD . "/" . $gambar);
                    $gambar = $file->getRandomName();
                    $lokasi_direktori = LOKASI_UPLOAD;
                    $file->move($lokasi_direktori, $gambar);
                }

                $record = [
                    'gambar' => $gambar,
                    'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
                    'id_galeri' => $id_galeri
                ];

                $model = new GaleriModel();
                $result = $model->insertgaleri($record);

                if ($result) {
                    session()->setFlashdata('success', 'Data galeri berhasil diupdate');
                    return redirect()->to('admin/galeri');
                } else {
                    session()->setFlashdata('warning', 'Gagal mengupdate data galeri');
                    return redirect()->to("admin/galeri/edit/{$id_galeri}");
                }
            }
        }

        $data['templateJudul'] = "Halaman Edit Galeri";

        echo view('admin/v_template_header', $data);
        echo view('admin/v_galeri_edit', $data);
        echo view('admin/v_template_footer', $data);
    }

    public function delete($id_galeri)
    {
        $dataGaleri = $this->galeriModel->getGaleri($id_galeri);

        if (!empty($dataGaleri)) {
            @unlink(LOKASI_UPLOAD . "/" . $dataGaleri['gambar']);
            $result = $this->galeriModel->deleteGaleri($id_galeri);

            if ($result) {
                session()->setFlashdata('success', 'Data galeri berhasil dihapus.');
            } else {
                session()->setFlashdata('warning', 'Data galeri gagal dihapus.');
            }
        }

        return redirect()->to('/admin/galeri');
    }
}
