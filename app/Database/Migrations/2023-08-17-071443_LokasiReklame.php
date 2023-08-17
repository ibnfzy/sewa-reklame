<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LokasiReklame extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_lokasi' => [
                'type' => 'INT',
                'constrain' => 5,
                'auto_increment' => true
            ],
            'nama_jalan' => [
                'type' => 'TEXT'
            ],
            'link_gmap' => [
                'type' => 'TEXT'
            ],
        ]);

        $this->forge->addKey('id_lokasi', true);

        $this->forge->createTable('lokasi_reklame');
    }

    public function down()
    {
        $this->forge->dropTable('lokasi_reklame');
    }
}