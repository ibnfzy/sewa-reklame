<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Corousel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_corousel' => [
                'type' => 'INT',
                'constraint' => 1,
                'auto_increment' => true
            ],
            'gambar' => [
                'type' => 'TEXT'
            ],
            'text' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ]
        ]);

        $this->forge->addKey('id_corousel', true);

        $this->forge->createTable('corousel');
    }

    public function down()
    {
        $this->forge->dropTable('corousel');
    }
}