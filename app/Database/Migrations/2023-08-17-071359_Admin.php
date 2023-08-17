<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin' => [
                'type' => 'INT',
                'constraint' => 2,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ],
            'password' => [
                'type' => 'TEXT'
            ],
            'fullname' => [
                'type' => 'VARCHAR',
                'constraint' => 25
            ]
        ]);

        $this->forge->addKey('id_admin', true);

        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}