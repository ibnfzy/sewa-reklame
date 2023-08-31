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
        return view('user/transaksi_belum_selesai', [
            'data' => $this->db->table('transaksi')
                ->where('id_customer', $_SESSION['id_customer'])
                ->notLike('status_transaksi', 'Selesai')
                ->orderBy('id_transaksi', 'DESC')->get()->getResultArray()
        ]);
    }

    public function transaksi_selesai()
    {
        return view('user/transaksi_selesai', [
            'data' => $this->db->table('transaksi')
                ->where('id_customer', $_SESSION['id_customer'])
                ->where('status_transaksi', 'Selesai')
                ->orderBy('id_transaksi', 'DESC')->get()->getResultArray()
        ]);
    }

    public function transaksi_detail($id)
    {
        return view('user/transaksi_detail', [
            'data' => $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray()
        ]);
    }

    public function proses_transaksi($id)
    {
        $get = $this->db->table('reklame')->where('id_reklame', $id)->get()->getRowArray();

        $data = [
            'id_reklame' => $id,
            'id_customer' => $_SESSION['id_customer'],
            'fullname' => $_SESSION['fullname'],
            'nama_reklame' => $get['nama_reklame'],
            'harga' => $get['harga_reklame'],
            'status_transaksi' => 'Desain',
        ];

        $this->db->table('transaksi')->insert($data);

        return redirect()->to(base_url('Panel/Transaksi'))->with('type-status', 'success')->with('message', 'Transaksi Berhasil dibuat');
    }


}