<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

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
            ],
            'jenis_post' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'tanggal_post' => [
                'type' => 'DATE',
                'default' => new RawSql('(CURRENT_DATE)')
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