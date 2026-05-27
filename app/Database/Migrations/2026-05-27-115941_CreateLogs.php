<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogs extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => ['type'=>'INT','auto_increment'=>true, 'unsigned' => true],
            'api_key_id' => ['type'=>'INT','unsigned' => true, 'null' => true],
            'method' => ['type'=>'VARCHAR','constraint'=>20, 'null'=>false],
            'endpoint' => ['type'=>'VARCHAR','constraint'=>255,],
            'status' => ['type'=>'INT', 'null'=>false],
            'created_at' => ['type'=>'DATETIME', 'null'=>false],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('api_key_id', 'api_keys', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('logs', true);
    }

    public function down()
    {
        $this->forge->dropTable('logs', true);
    }
}