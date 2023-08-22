<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserLogin extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('login/user_login');
    }

    public function auth()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $this->db->table('customer')->where('username', $username)->get()->getRowArray();

        if ($data) {
            $password_data = $data['password'];
            $id = $data['id_customer'];

            $verify = password_verify($password ?? '', $password_data);

            if ($verify) {
                $session->destroy();
                $sessionData = [
                    'id_customer' => $data['id_customer'],
                    'fullname' => $data['fullname'],
                    'username' => $data['username'],
                    'logged_in_customer' => TRUE
                ];

                $session->set($sessionData);
                // $session->markAsTempdata('logged_in_admin', 1800); //timeout 30 menit

                return redirect()->to(base_url('Panel'))->with('type-status', 'info')
                    ->with('message', 'Selamat Datang Kembali ' . $sessionData['fullname']);
            } else {
                return redirect()->to(base_url('Login/User'))->with('type-status', 'error')
                    ->with('message', 'Password tidak benar');
            }
        } else {
            return redirect()->to(base_url('Login/User'))->with('type-status', 'error')
                ->with('message', 'Username tidak benar');
        }
    }

    public function logoff()
    {
        $session = session();

        $session->destroy();

        return redirect()->to(base_url('Login/User'));
    }

    public function signup()
    {
        return view('login/user_signup');
    }

    public function save_data()
    {
        $rules = [
            'username' => 'required|max_length[16]',
            'fullname' => 'required|max_length[150]',
            'password' => 'required',
            'confirm_password' => 'matches[password]',
            'alamat' => 'required',
            'nomor_whatsapp' => 'required|max_length[13]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Login/Signup'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'nama_jalan' => $this->request->getPost('nama_jalan'),
            'link_gmap' => $this->request->getPost('link_gmap'),
        ];

        $this->db->table('lokasi_reklame')->insert($data);

        return redirect()->to(base_url('Login/User'))->with('type-status', 'success')->with('message', 'Data berhasil ditambahkan');
    }
}