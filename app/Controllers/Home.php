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
        return view('web/home', [
            'data' => $this->db->table('corousel')->get()->getResultArray(),
            'informasi' => $this->db->table('informasi')->where('id_toko_informasi', '1')->get()->getRowArray()
        ]);
    }

    public function katalog_lokasi()
    {
        return view('web/lokasi', [
            'data' => $this->db->table('lokasi_reklame')->get()->getResultArray()
        ]);
    }

    public function katalog_reklame($idl)
    {
        return view('web/reklame', [
            'data' => $this->db->table('reklame')->where('id_lokasi', $idl)->get()->getResultArray()
        ]);
    }

    public function reklame($id)
    {
        return view('web/reklame_detail', [
            'data' => $this->db->table('reklame')->where('id_reklame', $id)->get()->getRowArray()
        ]);
    }

    public function review_star($id)
    {
        $get = $this->db->table('review_reklame')->where('id_reklame', $id)->get()->getResultArray();

        $rt = [];
        $i = 1;

        foreach ($get as $item) {
            $rt[] = $item['bintang'];
        }

        $nilai = array_sum($rt);

        $pbagi = count($rt);

        try {
            $rating = $nilai / $pbagi;
        } catch (\Throwable $th) {
            $rating = 0;
        }

        $nbulat = round($rating);
        $nbulat = ($nbulat > 5) ? 5 : $nbulat;
        $star = '';

        if ($nbulat == 1) {
            $star = '⭐';

        } else if ($nbulat == 2) {
            $star = '⭐⭐';

        } else if ($nbulat == 3) {
            $star = '⭐⭐⭐';

        } else if ($nbulat == 4) {
            $star = '⭐⭐⭐⭐';

        } else if ($nbulat == 5) {
            $star = '⭐⭐⭐⭐⭐';

        }

        return $star;
    }

    public function total_review($id)
    {
        $get = $this->db->table('review_reklame')->where('id_reklame', $id)->get()->getResultArray();

        return count($get);
    }

    public function review($id)
    {
        return $this->db->table('review_reklame')->where('id_reklame', $id)->get()->getResultArray();
    }

    public function proses_redirect($id)
    {
        if ($this->request->getPost('hari') < 7) {
            return redirect()->to(base_url('Reklame/' . $id))->with('type-status', 'error')->with('message', 'Hari sewa minimal 7 Hari');
        }

        $date1 = new \DateTime(date('Y-m-d', strtotime($this->request->getPost('tanggal'))));
        $date2 = new \DateTime(date('Y-m-d'));

        $diff = $date1->diff($date2);
        $inday = (int) $diff->format("%r%a");


        if ($inday >= 1) {
            return redirect()->to(base_url('Reklame/' . $id))->with('type-status', 'error')->with('message', 'Tanggal sewa tidak benar');
        }

        session()->set('id_reklame_sewa', $id);
        session()->set('tanggal', $this->request->getPost('tanggal'));
        session()->set('hari', $this->request->getPost('hari'));

        return redirect()->to(base_url('Panel/Proses/' . $id));
    }
}