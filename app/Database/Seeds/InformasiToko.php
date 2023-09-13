<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InformasiToko extends Seeder
{
    public function run()
    {
        $this->db->table('informasi')->insert([
            'nomor_wa' => '6282194712245',
            'tentang' => $this->faker()->text
        ]);
    }
}