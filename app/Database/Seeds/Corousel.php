<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Corousel extends Seeder
{
    public function run()
    {
        $this->db->table('corousel')->insert([
            'gambar' => 'slider1.jpg',
            'text' => 'CV Duta Mandiri Advertising'
        ]);
    }
}