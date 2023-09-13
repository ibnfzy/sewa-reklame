<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TokoInformasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_toko_informasi' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nomor_wa' => [
                'type' => 'VARCHAR',
                'constraint' => 13
            ],
            'tentang' => [
                'type' => 'TEXT'
            ],
        ]);

        $this->forge->addKey('id_toko_informasi', true);

        $this->forge->createTable('informasi');
    }

    public function down()
    {
        $this->forge->dropTable('informasi');
    }
}