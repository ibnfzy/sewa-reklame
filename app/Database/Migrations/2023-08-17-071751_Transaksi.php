<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
// use CodeIgniter\Database\RawSql;

class Transaksi extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id_transaksi' => [
        //         'type' => 'INT',
        //         'constraint' => 5,
        //         'auto_increment' => true
        //     ],
        //     'id_customer' => [
        //         'type' => 'INT',
        //         'constraint' => 5
        //     ],
        //     'total_reklame' => [
        //         'type' => 'INT',
        //         'constraint' => 3
        //     ],
        //     'total_harga' => [
        //         'type' => 'INT',
        //         'constraint' => 10
        //     ],
        //     'potongan' => [
        //         'type' => 'INT',
        //         'constraint' => 2
        //     ],
        //     'status_transaksi' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 150
        //     ],
        //     'tgl_proses_checkout' => [
        //         'type' => 'DATE',
        //         'default' => new RawSql('(CURRENT_DATE)')
        //     ],
        //     'metode_pembayaran' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 150
        //     ]
        // ]);

        // $this->forge->addKey('id_transaksi', true);

        // $this->forge->createTable('transaksi');
    }

    public function down()
    {
        // $this->forge->dropTable('transaksi');
    }
}