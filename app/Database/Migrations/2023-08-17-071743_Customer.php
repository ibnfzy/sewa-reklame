<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_customer' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'fullname' => [
                'type' => 'VARCHAR',
                'constraint' => 150
            ],
            'password' => [
                'type' => 'TEXT'
            ],
            'alamat' => [
                'type' => 'TEXT'
            ],
            'nomor_wa' => [
                'type' => 'VARCHAR',
                'constraint' => 13
            ],
            'jenis_customer' => [
                'type' => 'VARCHAR',
                'default' => 'UMUM',
                'constraint' => 25
            ]
        ]);

        $this->forge->addKey('id_customer', true);

        $this->forge->createTable('customer');
    }

    public function down()
    {
        $this->forge->dropTable('customer');
    }
}