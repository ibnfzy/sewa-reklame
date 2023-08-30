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
        return view('web/lokasi', [
            'data' => $this->db->table('lokasi_reklame')->get()->getResultArray()
        ]);
    }

    public function katalog_reklame($idl)
    {
        return view('web/reklame', [
            'data' => $this->db->table('reklame')->where('id_lokasi', $idl)->where('status_reklame', 'Tersedia')->get()->getResultArray()
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
}