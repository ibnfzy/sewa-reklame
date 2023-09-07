<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UploadDesain extends Seeder
{
    public function run()
    {
        $this->db->table('transaksi_detail_desain')->insertBatch([
            [
                'id_transaksi' => '2',
                'gambar' => 'desain-2-07092023.jpg',
                'deskripsi_revisi' => 'TEST UPLOAD DESAIN',
                'jenis_post' => 'Desain',
            ],
            [
                'id_transaksi' => '2',
                'gambar' => 'desain-2-07092023.jpg',
                'deskripsi_revisi' => 'TEST UPLOAD DESAIN',
                'jenis_post' => 'Desain',
            ],
            [
                'id_transaksi' => '2',
                'gambar' => 'desain-2-07092023.jpg',
                'deskripsi_revisi' => 'TEST UPLOAD DESAIN',
                'jenis_post' => 'Desain',
            ],
            [
                'id_transaksi' => '2',
                'gambar' => 'desain-2-07092023.jpg',
                'deskripsi_revisi' => 'TEST UPLOAD DESAIN',
                'jenis_post' => 'Desain',
            ],
            [
                'id_transaksi' => '2',
                'gambar' => 'desain-2-07092023.jpg',
                'deskripsi_revisi' => 'TEST UPLOAD DESAIN',
                'jenis_post' => 'Desain',
            ],
            [
                'id_transaksi' => '2',
                'gambar' => 'desain-2-07092023.jpg',
                'deskripsi_revisi' => 'TEST UPLOAD DESAIN',
                'jenis_post' => 'Desain',
            ],
            [
                'id_transaksi' => '2',
                'gambar' => 'desain-2-07092023.jpg',
                'deskripsi_revisi' => 'TEST UPLOAD DESAIN',
                'jenis_post' => 'Desain',
            ],
            [
                'id_transaksi' => '2',
                'gambar' => 'desain-2-07092023.jpg',
                'deskripsi_revisi' => 'TEST UPLOAD DESAIN',
                'jenis_post' => 'Desain',
            ],
        ]);
    }
}