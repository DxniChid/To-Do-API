<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type'=>'INT','auto_increment'=>true],
            'method' => ['type'=>'VARCHAR','constraint'=>10],
            'endpoint' => ['type'=>'VARCHAR','constraint'=>255],
            'status' => ['type'=>'INT'],
            'api_key' => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('logs');
    }

    public function down()
    {
        $this->forge->dropTable('logs');
    }
}