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

        $harga = $get['harga_reklame'];

        if (session()->get('jenis_customer') != null && session()->get('jenis_customer') == 'Kerja Sama') {
            $harga = $get['harga_kerja_sama'];
        }

        $data = [
            'id_reklame' => $id,
            'id_customer' => $_SESSION['id_customer'],
            'fullname' => $_SESSION['fullname_customer'],
            'nama_reklame' => $get['nama_reklame'],
            'harga' => $harga,
            'status_transaksi' => 'Penyerahan Desain',
            'total_hari_sewa' => $this->request->getPost('hari')
        ];

        $this->db->table('transaksi')->insert($data);

        return redirect()->to(base_url('Panel/Transaksi'))->with('type-status', 'success')->with('message', 'Transaksi Berhasil dibuat');
    }

    public function batal_tranasksi($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->delete();

        return redirect()->to(base_url('Panel/Transaksi'))->with('type-status', 'success')->with('message', 'Transaksi Berhasil dihapus');
    }

    public function jenis_penyerahan($id)
    {
        $data = [
            'jenis_desain_reklame' => $this->request->getPost('jenis')
        ];

        $this->db->table('transaksi')->where('id_transaksi', $id)->update($data);

        return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Berhasil Memilih Jenis');
    }

    public function upload_desain_sendiri($id)
    {
        $rules = [
            'gambar' => 'is_image[gambar]',
            'deskripsi' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
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
            'jenis_post' => 'Desain Sendiri',
        ];

        $dataTransaksi = [
            'status_transaksi' => 'Menunggu Desain divalidasi'
        ];

        $this->db->table('transaksi')->where('id_transaksi', $id)->update($dataTransaksi);

        $this->db->table('transaksi_detail_desain')->insert($data);

        return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Data berhasil ditambahkan');
    }

    public function uploadBBDP($id)
    {
        $rules = [
            'gambar' => 'is_image[gambar]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $extFile = $this->request->getFile('gambar')->guessExtension();
        $namafile = 'buktibayardp-' . $id . date('-dmY.') . $extFile;

        if (!$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads', $namafile);
        }

        $data = [
            'id_transaksi' => $id,
            'gambar' => $namafile,
            'deskripsi_revisi' => 'Bukti Bayar DP',
            'jenis_post' => 'Upload Bukti Bayar'
        ];

        $dataTransaksi = [
            'status_transaksi' => 'Menunggu Validasi Bukti Bayar DP'
        ];

        $this->db->table('transaksi')->where('id_transaksi', $id)->update($dataTransaksi);

        $this->db->table('transaksi_detail_desain')->insert($data);

        return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Data berhasil ditambahkan');
    }

    public function uploadKriteriaDesain($id)
    {
        $rules = [
            'deskripsi' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        if ($this->request->getFile('gambar')->isValid()) {
            $extFile = $this->request->getFile('gambar')->guessExtension();
            $namafile = 'refdesain-' . $id . date('-dmY.') . $extFile;

            if (!$this->request->getFile('gambar')->hasMoved()) {
                $this->request->getFile('gambar')->move('uploads', $namafile);
            }

            $data = [
                'id_transaksi' => $id,
                'gambar' => $namafile,
                'deskripsi_revisi' => $this->request->getPost('deskripsi'),
                'jenis_post' => 'Referensi & Kriteria Desain',
            ];
        } else {
            $data = [
                'id_transaksi' => $id,
                'deskripsi_revisi' => $this->request->getPost('deskripsi'),
                'jenis_post' => 'Referensi & Kriteria Desain',
            ];
        }

        $this->db->table('transaksi_detail_desain')->insert($data);

        return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Data berhasil ditambahkan');
    }

    public function upload_revisi($id)
    {
        $rules = [
            'deskripsi' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        if ($this->request->getFile('gambar')->isValid()) {
            $extFile = $this->request->getFile('gambar')->guessExtension();
            $namafile = 'refdesain-' . $id . date('-dmY.') . $extFile;

            if (!$this->request->getFile('gambar')->hasMoved()) {
                $this->request->getFile('gambar')->move('uploads', $namafile);
            }

            $data = [
                'id_transaksi' => $id,
                'gambar' => $namafile,
                'deskripsi_revisi' => $this->request->getPost('deskripsi'),
                'jenis_post' => 'Revisi Desain',
            ];
        } else {
            $data = [
                'id_transaksi' => $id,
                'deskripsi_revisi' => $this->request->getPost('deskripsi'),
                'jenis_post' => 'Revisi Desain',
            ];
        }

        $this->db->table('transaksi_detail_desain')->insert($data);

        return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Data berhasil ditambahkan');
    }

    public function terima_desain($id)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id)->update([
            'status_transaksi' => 'Penyerahan Desain Berhasil'
        ]);

        return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Desain Berhasil Diterima');
    }
}