<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FakeTransaksi extends Seeder
{
    public function run()
    {
        $this->db->table('transaksi')->insertBatch(
            [
                [
                    'id_reklame' => '2',
                    'id_customer' => '1',
                    'fullname' => 'Mimin',
                    'nama_reklame' => 'TEST REKLAME 2',
                    'harga' => '200000',
                    'status_transaksi' => 'Selesai',
                    'jenis_desain_reklame' => 'Upload Sendiri',
                    'total_hari_sewa' => '30',
                    'tgl_sewa' => date('m/d/Y'),
                    'tgl_selesai' => date('m/d/Y', strtotime(date('m/d/Y') . '+ 30 Days'))
                ],
                [
                    'id_reklame' => '2',
                    'id_customer' => '1',
                    'fullname' => 'Mimin',
                    'nama_reklame' => 'TEST REKLAME 2',
                    'harga' => '200000',
                    'status_transaksi' => 'Selesai',
                    'jenis_desain_reklame' => 'Upload Sendiri',
                    'total_hari_sewa' => '30',
                    'tgl_sewa' => date('m/d/Y'),
                    'tgl_selesai' => date('m/d/Y', strtotime(date('m/d/Y') . '+ 30 Days'))
                ],
                [
                    'id_reklame' => '2',
                    'id_customer' => '1',
                    'fullname' => 'Mimin',
                    'nama_reklame' => 'TEST REKLAME 2',
                    'harga' => '200000',
                    'status_transaksi' => 'Selesai',
                    'jenis_desain_reklame' => 'Upload Sendiri',
                    'total_hari_sewa' => '30',
                    'tgl_sewa' => date('m/d/Y'),
                    'tgl_selesai' => date('m/d/Y', strtotime(date('m/d/Y') . '+ 30 Days'))
                ],
                [
                    'id_reklame' => '2',
                    'id_customer' => '1',
                    'fullname' => 'Mimin',
                    'nama_reklame' => 'TEST REKLAME 2',
                    'harga' => '200000',
                    'status_transaksi' => 'Selesai',
                    'jenis_desain_reklame' => 'Upload Sendiri',
                    'total_hari_sewa' => '30',
                    'tgl_sewa' => date('m/d/Y'),
                    'tgl_selesai' => date('m/d/Y', strtotime(date('m/d/Y') . '+ 30 Days'))
                ],
                [
                    'id_reklame' => '2',
                    'id_customer' => '1',
                    'fullname' => 'Mimin',
                    'nama_reklame' => 'TEST REKLAME 2',
                    'harga' => '200000',
                    'status_transaksi' => 'Selesai',
                    'jenis_desain_reklame' => 'Upload Sendiri',
                    'total_hari_sewa' => '30',
                    'tgl_sewa' => date('m/d/Y'),
                    'tgl_selesai' => date('m/d/Y', strtotime(date('m/d/Y') . '+ 30 Days'))
                ],
                [
                    'id_reklame' => '2',
                    'id_customer' => '1',
                    'fullname' => 'Mimin',
                    'nama_reklame' => 'TEST REKLAME 2',
                    'harga' => '200000',
                    'status_transaksi' => 'Selesai',
                    'jenis_desain_reklame' => 'Upload Sendiri',
                    'total_hari_sewa' => '30',
                    'tgl_sewa' => date('m/d/Y'),
                    'tgl_selesai' => date('m/d/Y', strtotime(date('m/d/Y') . '+ 30 Days'))
                ],
                [
                    'id_reklame' => '2',
                    'id_customer' => '1',
                    'fullname' => 'Mimin',
                    'nama_reklame' => 'TEST REKLAME 2',
                    'harga' => '200000',
                    'status_transaksi' => 'Selesai',
                    'jenis_desain_reklame' => 'Upload Sendiri',
                    'total_hari_sewa' => '30',
                    'tgl_sewa' => date('m/d/Y'),
                    'tgl_selesai' => date('m/d/Y', strtotime(date('m/d/Y') . '+ 30 Days'))
                ],
                [
                    'id_reklame' => '2',
                    'id_customer' => '1',
                    'fullname' => 'Mimin',
                    'nama_reklame' => 'TEST REKLAME 2',
                    'harga' => '200000',
                    'status_transaksi' => 'Selesai',
                    'jenis_desain_reklame' => 'Upload Sendiri',
                    'total_hari_sewa' => '30',
                    'tgl_sewa' => date('m/d/Y'),
                    'tgl_selesai' => date('m/d/Y', strtotime(date('m/d/Y') . '+ 30 Days'))
                ],
                [
                    'id_reklame' => '2',
                    'id_customer' => '1',
                    'fullname' => 'Mimin',
                    'nama_reklame' => 'TEST REKLAME 2',
                    'harga' => '200000',
                    'status_transaksi' => 'Selesai',
                    'jenis_desain_reklame' => 'Upload Sendiri',
                    'total_hari_sewa' => '30',
                    'tgl_sewa' => date('m/d/Y'),
                    'tgl_selesai' => date('m/d/Y', strtotime(date('m/d/Y') . '+ 30 Days'))
                ],
                [
                    'id_reklame' => '2',
                    'id_customer' => '1',
                    'fullname' => 'Mimin',
                    'nama_reklame' => 'TEST REKLAME 2',
                    'harga' => '200000',
                    'status_transaksi' => 'Selesai',
                    'jenis_desain_reklame' => 'Upload Sendiri',
                    'total_hari_sewa' => '30',
                    'tgl_sewa' => date('m/d/Y'),
                    'tgl_selesai' => date('m/d/Y', strtotime(date('m/d/Y') . '+ 30 Days'))
                ],
                [
                    'id_reklame' => '2',
                    'id_customer' => '1',
                    'fullname' => 'Mimin',
                    'nama_reklame' => 'TEST REKLAME 2',
                    'harga' => '200000',
                    'status_transaksi' => 'Selesai',
                    'jenis_desain_reklame' => 'Upload Sendiri',
                    'total_hari_sewa' => '30',
                    'tgl_sewa' => date('m/d/Y'),
                    'tgl_selesai' => date('m/d/Y', strtotime(date('m/d/Y') . '+ 30 Days'))
                ],
            ]
        );
    }
}