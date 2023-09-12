<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Reklame extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/reklame', [
            'data' => $this->db->table('reklame')->get()->getResultArray()
        ]);
    }

    public function add()
    {
        return view('admin/reklame_add', [
            'lokasi' => $this->db->table('lokasi_reklame')->get()->getResultArray()
        ]);
    }

    public function create()
    {
        $rules = [
            'id_lokasi' => 'required',
            'nama_reklame' => 'required',
            'gambar' => 'is_image[gambar]|max_size[gambar,2048]',
            'tinggi_reklame' => 'required',
            'lebar_reklame' => 'required',
            'bentuk_reklame' => 'required',
            'harga_reklame' => 'required',
            'deskripsi' => 'required',
            'lightning' => 'required',
            'formasi' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/Reklame/add'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $getLokasi = $this->db->table('lokasi_reklame')->where('id_lokasi', $this->request->getPost('id_lokasi'))->get()->getRowArray();

        if (!$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads');
        }

        $data = [
            'id_lokasi' => $this->request->getPost('id_lokasi'),
            'nama_reklame' => $this->request->getPost('nama_reklame'),
            'gambar' => $this->request->getFile('gambar')->getName(),
            'lokasi' => $getLokasi['nama_jalan'],
            'tinggi_reklame' => $this->request->getPost('tinggi_reklame'),
            'lebar_reklame' => $this->request->getPost('lebar_reklame'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'bentuk_reklame' => $this->request->getPost('bentuk_reklame'),
            'harga_reklame' => $this->request->getPost('harga_reklame'),
            'status_reklame' => 'Tersedia',
            'lightning' => $this->request->getPost('lightning'),
            'formasi' => $this->request->getPost('formasi')
        ];

        $this->db->table('reklame')->insert($data);

        return redirect()->to(base_url('AdminPanel/Reklame'))->with('type-status', 'success')->with('message', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('admin/reklame_edit', [
            'lokasi' => $this->db->table('lokasi_reklame')->get()->getResultArray(),
            'data' => $this->db->table('reklame')->where('id_reklame', $id)->get()->getRowArray()
        ]);
    }

    public function update($id)
    {
        $getLokasi = $this->db->table('lokasi_reklame')->where('id_lokasi', $this->request->getPost('id_lokasi'))->get()->getRowArray();

        if ($this->request->getFile('gambar')->isValid()) {
            $rules = [
                'id_lokasi' => 'required',
                'nama_reklame' => 'required',
                'gambar' => 'is_image[gambar]|max_size[gambar,2048]',
                'tinggi_reklame' => 'required',
                'lebar_reklame' => 'required',
                'bentuk_reklame' => 'required',
                'harga_reklame' => 'required',
                'deskripsi' => 'required',
                'lightning' => 'required',
                'formasi' => 'required'
            ];

            $data = [
                'id_lokasi' => $this->request->getPost('id_lokasi'),
                'nama_reklame' => $this->request->getPost('nama_reklame'),
                'gambar' => $this->request->getFile('gambar')->getName(),
                'lokasi' => $getLokasi['nama_jalan'],
                'tinggi_reklame' => $this->request->getPost('tinggi_reklame'),
                'lebar_reklame' => $this->request->getPost('lebar_reklame'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'bentuk_reklame' => $this->request->getPost('bentuk_reklame'),
                'harga_reklame' => $this->request->getPost('harga_reklame'),
                'status_reklame' => 'Tersedia',
                'lightning' => $this->request->getPost('lightning'),
                'formasi' => $this->request->getPost('formasi')
            ];
        } else {
            $rules = [
                'id_lokasi' => 'required',
                'nama_reklame' => 'required',
                'tinggi_reklame' => 'required',
                'lebar_reklame' => 'required',
                'deskripsi' => 'required',
                'bentuk_reklame' => 'required',
                'harga_reklame' => 'required',
                'lightning' => 'required',
                'formasi' => 'required'
            ];

            $data = [
                'id_lokasi' => $this->request->getPost('id_lokasi'),
                'nama_reklame' => $this->request->getPost('nama_reklame'),
                'lokasi' => $getLokasi['nama_jalan'],
                'tinggi_reklame' => $this->request->getPost('tinggi_reklame'),
                'lebar_reklame' => $this->request->getPost('lebar_reklame'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'status_reklame' => 'Tersedia',
                'bentuk_reklame' => $this->request->getPost('bentuk_reklame'),
                'harga_reklame' => $this->request->getPost('harga_reklame'),
                'lightning' => $this->request->getPost('lightning'),
                'formasi' => $this->request->getPost('formasi')
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/Reklame/' . $id))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        if ($this->request->getFile('gambar')->isValid() && !$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads');
        }

        $this->db->table('reklame')->where('id_reklame', $id)->update($data);

        return redirect()->to(base_url('AdminPanel/Reklame'))->with('type-status', 'info')
            ->with('message', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $this->db->table('reklame')->delete($id);

        return redirect()->to(base_url('AdminPanel/Reklame'))->with('type-status', 'info')
            ->with('message', 'Data berhasil dihapus');
    }
}