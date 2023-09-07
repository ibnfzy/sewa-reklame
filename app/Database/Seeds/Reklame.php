<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Reklame extends Seeder
{
    public function run()
    {
        $this->db->table('reklame')->insertBatch([
            [
                'id_lokasi' => '1',
                'nama_reklame' => 'TEST REKLAME',
                'gambar' => 'wp2754860.jpg',
                'lokasi' => 'Jalan Toddopuli Raya ',
                'tinggi_reklame' => '200',
                'lebar_reklame' => '400',
                'deskripsi' => 'TEST INPUT',
                'status_reklame' => 'Tersedia',
                'bentuk_reklame' => 'horizon',
                'harga_reklame' => '200000',
                'lightning' => '6',
                'formasi' => '1',
                'tgl_insert' => date('Y-m-d')
            ],
            [
                'id_lokasi' => '1',
                'nama_reklame' => 'TEST REKLAME 2',
                'gambar' => 'dsa.jpg',
                'lokasi' => 'Jalan Toddopuli Raya ',
                'tinggi_reklame' => '400',
                'lebar_reklame' => '200',
                'deskripsi' => $this->faker()->realText(),
                'status_reklame' => 'Tersedia',
                'bentuk_reklame' => 'Vertical',
                'harga_reklame' => '200000',
                'lightning' => '4',
                'formasi' => '2',
                'tgl_insert' => date('Y-m-d')
            ],
        ]);
    }
}