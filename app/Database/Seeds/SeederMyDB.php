<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederMyDB extends Seeder
{
    public function run()
    {
        $this->call('Admin');
        $this->call('Customer');
    }
}