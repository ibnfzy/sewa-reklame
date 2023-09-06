<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdmController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/home');
    }

    public function transaksi()
    {
        return view('admin/transaksi', [
            'data' => $this->db->table('transaksi')->orderBy('id_transaksi', 'DESC')->get()->getResultArray()
        ]);
    }

    public function transaksi_detail($id)
    {
        return view('admin/transaksi_detail', [
            'data' => $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray()
        ]);
    }

    public function validasi_desain($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Penyerahan Desain Berhasil'
        ]);

        return redirect()->to(base_url('AdminPanel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Berhasil Validasi Desain');
    }

    public function validasibbdp($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Pengerjaan Reklame Diproses'
        ]);

        return redirect()->to(base_url('AdminPanel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Berhasil Validasi Bukti Bayar DP');
    }

    public function laporan_cust()
    {
        //
    }

    public function laporan_transaksi()
    {
        //
    }
}