<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederMyDB extends Seeder
{
    public function run()
    {
        $this->call('Admin');
        $this->call('Customer');
        $this->call('LokasiReklame');
        $this->call('Reklame');
        $this->call('Corousel');
        $this->call('InformasiToko');
    }
}