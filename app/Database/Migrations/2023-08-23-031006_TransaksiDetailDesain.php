<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransaksiDetailDesain extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi_detail_desain' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'gambar' => [
                'type' => 'TEXT'
            ],
            'deskripsi_revisi' => [
                'type' => 'TEXT'
            ]
        ]);

        $this->forge->addKey('id_transaksi_detail_desain', true);

        $this->forge->createTable('transaksi_detail_desain');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_detail_desain');
    }
}