<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ReviewReklame extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_review' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_reklame' => [
                'type' => 'INT'
            ],
            'id_customer' => [
                'type' => 'INT'
            ],
            'isi_testimoni' => [
                'type' => 'TEXT'
            ],
            'bintang' => [
                'type' => 'INT'
            ],
            'insert_datetime' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ]
        ]);

        $this->forge->addKey('id_review', true);

        $this->forge->createTable('review_reklame');
    }

    public function down()
    {
        $this->forge->dropTable('review_reklame');
    }
}