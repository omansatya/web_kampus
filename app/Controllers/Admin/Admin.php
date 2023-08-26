<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Admin extends BaseController
{
    function __construct()
    {
        $this->m_admin = new AdminModel();
        $this->validation = \Config\Services::validation();
        helper('cookie');
        helper('global_fungsi_helper');
    }
    
    public function login()
    {
        // Logika untuk halaman login
        $data = []; 

        //$data = [];
        //session()->destroy();
        //exit();

        if (get_cookie('cookie_username') && get_cookie('cookie_password')) {
            # code...
            $username = get_cookie('cookie_username');
            $password = get_cookie('cookie_password');

            $dataAkun = $this->m_admin->getData($username);
            if ($password != $dataAkun['password']) {
                $err[] = "Akun yang dimasukkan tidak sesuai";
                session()->setFlashdata('username', $username);
                session()->setFlashdata('warning', $err);

                delete_cookie("cookie_username");
                delete_cookie('cookie_password');
                return redirect()->to('admin/login');
            }

            $akun = [
                'akun_username' => $username,
                'akun_nama_lengkap' => $dataAkun['nama_lengkap'],
                'akun_emaill' => $dataAkun['email']
            ];
            session()->set($akun);
            return redirect()->to('admin/sukses');

        };
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username tidak boleh kosong'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi'
                    ]
                ]
            ];
        
            if (!$this->validate($rules)) {
                session()->setFlashdata("warning", $this->validation->getErrors());
                return redirect()->to("admin/login");
            } else {
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                $remember_me = $this->request->getVar('remember_me');
        
                $dataAkun = $this->m_admin->getData($username);
                if (empty($dataAkun) || !password_verify($password, $dataAkun['password'])) {
                    $err[] = "Akun yang Anda masukkan tidak sesuai.";
                    session()->setFlashdata('username', $username);
                    session()->setFlashdata('warning', $err);
                    return redirect()->to("admin/login");
                }

                if ($remember_me == '1') {
                    set_cookie("cookie_username" , $username, 3600*24*30);
                    set_cookie("cookie_password" , $dataAkun['password'], 3600*24*30);
                }

                $akun = [
                    'akun_username' => $dataAkun['username'],
                    'akun_nama_lengkap' => $dataAkun['nama_lengkap'],
                    'akun_email' => $dataAkun['email'],
                ];
                session()->set($akun);
                return redirect()->to("admin/sukses")->withCookies();
            }

        }
        echo view("admin/v_login", $data);    
    }
     function sukses()
     {
         return redirect()->to('admin/article');
        // print_r(session()->get());
        // echo "ISIAN COOKIE USERNAME " .get_cookie("cookie_username"). " DAN PASSWORD ".get_cookie("cookie_password"); 
    }

    function logout(){
        delete_cookie('cookie_username');
        delete_cookie('cookie_password');
        session()->destroy();
        if (session()->get('akun_username') != '') {
            session()->setFlashdata('success', 'Anda berhasil Logout');
        }
        echo view('admin/v_login');
    }

    function lupapassword(){
        $err = [];
        if ($this->request->getMethod() == 'post') {
            $username = $this->request->getVar('username');
            if ($username == '') {
                $err[] = "Silahkan masukkan username atau e-mail yang anda punya";
            }
            if (empty($err)) {
                $data = $this->m_admin->getdata($username);
                if (empty($data)) {
                    $err[] = "akun yang kamu masukkan tidak ditemukan";
                }
            }
            if (empty($err)) {
                $email = $data['email'];
                $token = md5(date('ymdhis'));

                $link = site_url("admin/resetpassword/?email=$email=$email&token=$token ");
                $attachment = "";
                $to = $email;
                $title = "Reset password";
                $message = "berikut ini adalah link untuk melakan reset password anda";
                $message .= " silahkan klik link berikut ini $link"; 

                kirim_email($attachment, $to, $title, $message);

                $dataUpdate = [
                    'email' => $email,
                    'token' => $token
                ];
                $this->m_admin->updateData($dataUpdate);
                session()->setFlashdata("success", "email untuk recovery sudah kami kirimkan ke email anda");
            }
            if ($err) {
                session()->setFlashdata("username",$username);
                session()->setFlashdata("warning", $err);
            }
            return redirect()->to("admin/lupapassword");
        }
        echo view('admin/v_lupapassword');
    }

    function resetpassword()
    {
        $err = [];
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');
        if ($email != '' and $token != '') {
            $dataAkun = $this->m_admin->getData($email); //<-- cek di tabel admin
            if ($dataAkun !== null && isset($dataAkun['token']) && $dataAkun['token'] == $token) {
                $err[] = "Token tidak valid";
            }
        } else {
            $err[] = "Parameter yang dikirimkan tidak valid";
        }

        if ($err) {
            session()->setFlashdata("warning", $err);
        }

        if ($this->request->getMethod() == 'post') {
            $aturan = [
                'password' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'min_length' => 'Panjang karakter minimum untuk password adalah 5 karakter'
                    ]
                ],
                'konfirmasi_password' => [
                    'rules' => 'required|min_length[5]|matches[password]',
                    'errors' => [
                        'required' => 'Konfirmasi password harus diisi',
                        'min_length' => 'Panjang karakter minimum untuk konfirmasi password adalah 5 karakter',
                        'matches' => 'Konfirmasi password tidak sesuai dengan password yang diisikan'
                    ]
                ]
            ];

            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $dataUpdate = [
                    'email' => $email,
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'token' => null
                ];
                $this->m_admin->updateData($dataUpdate);
                session()->setFlashdata('success', 'Password berhasil direset, silakan login');

                delete_cookie('cookie_username');
                delete_cookie('cookie_password');

                return redirect()->to('admin/login')->withCookies();
            }
        }

        echo view("admin/v_resetpassword");
    }
}