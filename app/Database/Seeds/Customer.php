<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Customer extends Seeder
{
    public function run()
    {
        $this->db->table('customer')->insert([
            'username' => 'admin',
            'fullname' => 'Mimin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'alamat' => 'Jl. Hertasning',
            'nomor_wa' => '6285158668102'
        ]);
    }
}