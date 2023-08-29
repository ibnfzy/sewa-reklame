<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index(): string
    {
        return view('web/home');
    }

    public function katalog_lokasi()
    {
        return view('web/lokasi');
    }
}