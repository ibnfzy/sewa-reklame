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
        return view('admin/home', [
            'data' => $this->db->table('informasi')->where('id_toko_informasi', 1)->get()->getRowArray(),
            'transaksi' => $this->db->query('SELECT DISTINCT id_reklame, COUNT(DISTINCT id_customer) as total_customer, COUNT(id_transaksi) as total_transaksi, nama_reklame, SUM(harga * total_hari_sewa) as total_harga FROM `transaksi` GROUP BY id_reklame LIMIT 5')->getResultArray(),
            'reklame' => $this->db->table('reklame')->get(5)->getResultArray()
        ]);
    }

    public function updateInformasi()
    {
        $this->db->table('informasi')->where('id_toko_informasi', 1)->update([
            'nomor_wa' => '62' . $this->request->getPost('nomor_wa')
        ]);

        return redirect()->to(base_url('AdminPanel'))->with('type-status', 'success')->with('message', 'Berhasil Update Informasi');
    }

    public function updateTentang()
    {
        $this->db->table('informasi')->where('id_toko_informasi', 1)->update([
            'tentang' => $this->request->getPost('tentang')
        ]);

        return redirect()->to(base_url('AdminPanel'))->with('type-status', 'success')->with('message', 'Berhasil Update Informasi');
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

    public function validasilunas($id)
    {
        $lunas = false;
        $bayarDP = false;
        $get = $this->db->table('transaksi_detail_desain')->where('id_transaksi', $id)->get()->getResultArray();
        $getTransaksi = $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray();

        foreach ($get as $mo) {
            if (in_array('Bukti Bayar DP', $mo)) {
                $bayarDP = true;
            }

            if (in_array('Bukti Bayar Lunas', $mo)) {
                $lunas = true;
            }
        }

        if ($bayarDP == true && $lunas == true) {
            $this->db->table('transaksi')->where('id_transaksi', $id)->update([
                'status_transaksi' => 'Transaksi Selesai'
            ]);
        }

        if ($bayarDP == false && $lunas == true) {
            $this->db->table('transaksi')->where('id_transaksi', $id)->update([
                'status_transaksi' => 'Proses Review Tanggal Sewa'
            ]);
        }

        $this->db->table('reklame')->where('id_reklame', $getTransaksi['id_reklame'])->update(['status_reklame' => 'Tidak Tersedia']);

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
        $get = $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray();

        $format = $get['total_hari_sewa'] - (($get['total_hari_sewa'] * 10) / 100);

        $format = 0.9;

        $format = (gettype($format) == 'double') ? round($format) : $format;

        $format = ($format < 1) ? 1 : $format;

        $formatDay = "+$format Days";

        $getJatuhTempo = date('Y-m-d', strtotime($formatDay));

        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Pengerjaan Selesai',
            'tgl_jatuh_tempo' => $getJatuhTempo
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
        return view('admin/laporan_cust', [
            'data' => $this->db->table('customer')->get()->getResultArray()
        ]);
    }

    public function laporan_transaksi()
    {
        return view('admin/laporan_transaksi', [
            'data' => $this->db->query('SELECT * FROM `transaksi`')->getResultArray()
        ]);
    }

    public function lanjut_transaksi($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Transaksi Selesai'
        ]);

        return redirect()->to(base_url('AdminPanel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Berhasil Menyelesaikan Transaksi');
    }
}