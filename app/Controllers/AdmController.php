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
            'status_transaksi' => 'Proses Review Tanggal Sewa'
        ]);

        return redirect()->to(base_url('AdminPanel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Berhasil Validasi Bukti Bayar DP');
    }

    public function upload_dokumentasi($id)
    {
        $rules = [
            'gambar' => 'is_image[gambar]',
            'deskripsi' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/Transaksi/' . $id))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $extFile = $this->request->getFile('gambar')->guessExtension();
        $namafile = 'dokumentasi-' . $id . date('-dmY.') . $extFile;

        if (!$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads', $namafile);
        }

        $data = [
            'id_transaksi' => $id,
            'gambar' => $namafile,
            'deskripsi_revisi' => $this->request->getPost('deskripsi'),
            'jenis_post' => 'Dokumentasi',
        ];

        $this->db->table('transaksi_detail_desain')->insert($data);

        return redirect()->to(base_url('AdminPanel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Data berhasil ditambahkan');
    }

    public function pengerjaan_selesai($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Pengerjaan Selesai'
        ]);

        return redirect()->to(base_url('AdminPanel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Pengerjaan Selesai');
    }

    public function upload_desain($id)
    {
        $rules = [
            'gambar' => 'is_image[gambar]',
            'deskripsi' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/Transaksi/' . $id))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $extFile = $this->request->getFile('gambar')->guessExtension();
        $namafile = 'desain-' . $id . date('-dmY.') . $extFile;

        if (!$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads', $namafile);
        }

        $data = [
            'id_transaksi' => $id,
            'gambar' => $namafile,
            'deskripsi_revisi' => $this->request->getPost('deskripsi'),
            'jenis_post' => 'Desain',
        ];

        $this->db->table('transaksi_detail_desain')->insert($data);

        return redirect()->to(base_url('AdminPanel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Data berhasil ditambahkan');
    }

    public function customer()
    {
        return view('admin/cust', [
            'data' => $this->db->table('customer')->get()->getResultArray()
        ]);
    }

    public function custkerja($id)
    {
        $this->db->table('customer')->where('id_customer', $id)->update([
            'jenis_customer' => 'Kerja Sama'
        ]);

        return redirect()->to(base_url('AdminPanel/Customer'))->with('type-status', 'success')->with('message', 'Data berhasil diubah');
    }

    public function custumum($id)
    {
        $this->db->table('customer')->where('id_customer', $id)->update([
            'jenis_customer' => 'Umum'
        ]);

        return redirect()->to(base_url('AdminPanel/Customer'))->with('type-status', 'success')->with('message', 'Data berhasil diubah');
    }

    public function validasi_tgl($id)
    {
        $get = $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray();

        $tgl_selesai = date('m/d/Y', strtotime($get['tgl_sewa'] . ' + ' . $get['total_hari_sewa'] . ' days'));

        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Pengerjaan Reklame Diproses',
            'tgl_selesai' => $tgl_selesai
        ]);

        return redirect()->to(base_url('AdminPanel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Berhasil Validasi Tanggal Sewa');
    }

    public function update_tgl($id)
    {
        $get = $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray();

        $tgl_selesai = date('m/d/Y', strtotime($this->request->getPost('tanggal') . ' + ' . $get['total_hari_sewa'] . ' days'));

        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Pengerjaan Reklame Diproses',
            'tgl_sewa' => date('m/d/Y', strtotime($this->request->getPost('tanggal'))),
            'tgl_selesai' => $tgl_selesai
        ]);

        return redirect()->to(base_url('AdminPanel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Berhasil Validasi Tanggal Sewa');
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