<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Reklame extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_reklame' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'id_lokasi' => [
                'type' => 'INT',
                'constrain' => 5
            ],
            'nama_reklame' => [
                'type' => 'VARCHAR',
                'constraint' => 250
            ],
            'gambar' => [
                'type' => 'TEXT'
            ],
            'lokasi' => [
                'type' => 'TEXT'
            ],
            'tinggi_reklame' => [
                'type' => 'VARCHAR',
                'constraint' => 3
            ],
            'lebar_reklame' => [
                'type' => 'VARCHAR',
                'constraint' => 3
            ],
            'deskripsi' => [
                'type' => 'TEXT'
            ],
            'status_reklame' => [
                'type' => 'VARCHAR',
                'constraint' => 150
            ],
            'bentuk_reklame' => [
                'type' => 'VARCHAR',
                'constraint' => 11
            ],
            'harga_reklame' => [
                'type' => 'INT',
            ],
            'lightning' => [
                'type' => 'CHAR',
                'constraint' => 2
            ],
            'formasi' => [
                'type' => 'CHAR'
            ],
            'tgl_insert' => [
                'type' => 'DATE',
                'default' => new RawSql('(CURRENT_DATE)')
            ]
        ]);

        $this->forge->addKey('id_reklame', true);

        $this->forge->createTable('reklame');
    }

    public function down()
    {
        $this->forge->dropTable('reklame');
    }
}