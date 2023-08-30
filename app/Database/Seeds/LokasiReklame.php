<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LokasiReklame extends Seeder
{
    public function run()
    {
        $this->db->table('lokasi_reklame')->insert([
            'nama_jalan' => 'Jalan Toddopuli Raya',
            'link_gmap' => 'https://goo.gl/maps/bZ5YLpGWFMpqJEgP9'
        ]);
    }
}