<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class TransaksiDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi_detail' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'id_reklame' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'id_customer' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'fullname' => [
                'type' => 'VARCHAR',
                'constraint' => 150
            ],
            'nama_reklame' => [
                'type' => 'VARCHAR',
                'constraint' => 250
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 10
            ],
            'status_transaksi' => [
                'type' => 'VARCHAR',
                'constraint' => 150
            ],
            'tgl_proses_checkout' => [
                'type' => 'DATE',
                'default' => new RawSql('(CURRENT_DATE)')
            ],
            'jenis_desain_reklame' => [
                'type' => 'VARCHAR',
                'constraint' => 150
            ]
        ]);

        $this->forge->addKey('id_transaksi_detail', true);

        $this->forge->createTable('transaksi_detail');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_detail');
    }
}