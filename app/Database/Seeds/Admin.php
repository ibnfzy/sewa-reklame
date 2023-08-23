<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Admin extends Seeder
{
    public function run()
    {
        $this->db->table('admin')->insert([
            'username' => 'admin',
            'fullname' => 'Adrian',
            'password' => password_hash('admin', PASSWORD_DEFAULT)
        ]);
    }
}