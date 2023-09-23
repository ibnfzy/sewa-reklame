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
        return view('user/home', [
            'ts' => count($this->db->table('transaksi')
                ->where('id_customer', $_SESSION['id_customer'])
                ->where('status_transaksi', 'Selesai')->get()->getResultArray()),
            'tbs' => count($this->db->table('transaksi')
                ->where('id_customer', $_SESSION['id_customer'])
                ->notLike('status_transaksi', 'Transaksi Selesai')
                ->orderBy('id_transaksi', 'DESC')->get()->getResultArray()),
            'uang' => $this->db->table('transaksi')->select('sum(harga * total_hari_sewa) as total_bayar')->where('id_customer', session()->get('id_customer'))->get()->getRowArray()
        ]);
    }

    public function transaksi_bs()
    {
        return view('user/transaksi_belum_selesai', [
            'data' => $this->db->table('transaksi')
                ->where('id_customer', $_SESSION['id_customer'])
                ->notLike('status_transaksi', 'Transaksi Selesai')
                ->orderBy('id_transaksi', 'DESC')->get()->getResultArray()
        ]);
    }

    public function transaksi()
    {
        return view('user/transaksi', [
            'data' => $this->db->table('transaksi')
                ->where('id_customer', $_SESSION['id_customer'])
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
        $data = $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray();

        return view('user/transaksi_detail', [
            'data' => $data,
            'testi' => count($this->db->table('review_reklame')->where('id_reklame', $data['id_reklame'])->get()->getResultArray())
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
            'total_hari_sewa' => session()->get('hari'),
            'tgl_sewa' => date('m/d/Y', strtotime(session()->get('tanggal')))
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
            'jenis_pembayaran' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $extFile = $this->request->getFile('gambar')->guessExtension();
        $namafile = 'buktibayardp-' . $id . date('-dmY.') . $extFile;

        if (!$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads', $namafile);
        }

        $deskripsi = ($this->request->getPost('jenis_pembayaran') == '1') ? 'Bukti Bayar Lunas' : 'Bukti Bayar DP';

        $data = [
            'id_transaksi' => $id,
            'gambar' => $namafile,
            'deskripsi_revisi' => $deskripsi,
            'jenis_post' => 'Upload Bukti Bayar'
        ];

        $dataTransaksi = [
            'status_transaksi' => 'Menunggu Validasi ' . $deskripsi
        ];

        $this->db->table('transaksi')->where('id_transaksi', $id)->update($dataTransaksi);

        $this->db->table('transaksi_detail_desain')->insert($data);

        return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Data berhasil ditambahkan');
    }

    public function uploadLunas($id)
    {
        $rules = [
            'gambar' => 'is_image[gambar]'
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
            'deskripsi_revisi' => 'Bukti Bayar Lunas',
            'jenis_post' => 'Upload Bukti Bayar'
        ];

        $dataTransaksi = [
            'status_transaksi' => 'Menunggu Validasi Bukti Bayar Lunas'
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

    public function testimoni_add($id)
    {
        $rules = [
            'bintang' => 'required',
            'deskripsi' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $get = $this->db->table('transaksi')->where('id_transaksi', $id)->get()->getRowArray();

        $data = [
            'id_reklame' => $get['id_reklame'],
            'id_customer' => $get['id_customer'],
            'isi_testimoni' => $this->request->getPost('deskripsi'),
            'bintang' => $this->request->getPost('bintang'),
            'insert_datetime' => date('D M Y - H:i')
        ];

        $this->db->table('review_reklame')->insert($data);

        return redirect()->to(base_url('Panel/Transaksi/' . $id))->with('type-status', 'success')->with('message', 'Review berhasil ditambahkan');
    }

    public function testimoni()
    {
        return view('user/testimoni', [
            'data' => $this->db->table('review_reklame')->where('id_customer', session()->get('id_customer'))->get()->getResultArray()
        ]);
    }

    public function testimoni_delete($id)
    {
        $this->db->table('review_reklame')->where('id_review_reklame', $id)->delete();

        return redirect()->to(base_url('Panel/Testimoni'))->with('type-status', 'success')->with('message', 'Review berhasil dihapus');
    }

    public function informasi_update()
    {
        $this->db->table('customer')->where('id_customer', session()->get('id_customer'))->update([
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'alamat' => $this->request->getPost('alamat'),
            'nomor_wa' => $this->request->getPost('nomor_wa')
        ]);

        session()->set('fullname_customer', $this->request->getPost('fullname'));
        session()->set('username_customer', $this->request->getPost('username'));
        session()->set('alamat_customer', $this->request->getPost('alamat'));
        session()->set('nomor_wa', $this->request->getPost('nomor_wa'));

        return redirect()->to(base_url('Panel'))->with('type-status', 'success')->with('message', 'Informasi Berhasil Diupdate');
    }

    public function password_update()
    {
        $rules = [
            'password_lama' => 'required',
            'password' => 'required',
            'confirm_password' => 'matches[password]',
        ];

        $check = $this->db->table('customer')->where('id_customer', session()->get('id_customer'))->get()->getRowArray();

        if (!password_verify($this->request->getPost('password_lama'), $check['password'])) {
            return redirect()->to(base_url('Panel'))->with('type-status', 'error')->with('message', 'Password Lama Tidak Benar');
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Panel'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        $this->db->table('customer')->where('id_customer', session()->get('id_customer'))->update($data);

        return redirect()->to(base_url('Panel'))->with('type-status', 'success')->with('message', 'Password berhasil diperbarui');
    }
}