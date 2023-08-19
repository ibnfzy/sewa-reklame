<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LokasiReklame extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/lokasi', [
            'data' => $this->db->table('lokasi_reklame')->get()->getResultArray()
        ]);
    }

    public function add()
    {
        return view('admin/lokasi_add');
    }

    public function create()
    {
        $rules = [
            'nama_jalan' => 'required',
            'link_gmap' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/LokasiReklame/add'))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'nama_jalan' => $this->request->getPost('nama_jalan'),
            'link_gmap' => $this->request->getPost('link_gmap'),
        ];

        $this->db->table('lokasi_reklame')->insert($data);

        return redirect()->to(base_url('AdminPanel/LokasiReklame'))->with('type-status', 'success')->with('message', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('admin/lokasi_edit', [
            'data' => $this->db->table('lokasi_reklame')->where('id_lokasi', $id)->get()->getRowArray()
        ]);
    }

    public function update($id)
    {
        $rules = [
            'nama_jalan' => 'required',
            'link_gmap' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/LokasiReklame/' . $id))->with('type-status', 'error')->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'nama_jalan' => $this->request->getPost('nama_jalan'),
            'link_gmap' => $this->request->getPost('link_gmap'),
        ];

        $this->db->table('lokasi_reklame')->where('id_lokasi', $id)->update($data);

        return redirect()->to(base_url('AdminPanel/LokasiReklame'))->with('type-status', 'success')->with('message', 'Data berhasil ditambahkan');
    }

    public function delete($id)
    {
        $this->db->table('lokasi_reklame')->where('id_lokasi', $id)->delete();

        return redirect()->to(base_url('AdminPanel/LokasiReklame'))->with('type-status', 'info')
            ->with('message', 'Data berhasil dihapus');
    }
}