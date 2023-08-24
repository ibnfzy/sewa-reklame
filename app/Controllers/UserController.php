<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('user/home');
    }

    public function transaksi_bs()
    {
        return view('user/transaksi_belum_selesai');
    }

    public function transaksi_selesai()
    {
        return view('user/transaksi_selesai');
    }
}