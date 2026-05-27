<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApiKeys extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => ['type'=>'INT','auto_increment'=>true, 'unsigned' => true],
            'user_id' => ['type'=>'INT','unsigned' => true, 'null' => false],
            'key' => ['type'=>'VARCHAR','constraint'=>255, 'null'=>false],
            'created_at' => ['type'=>'DATETIME', 'null'=>true],
            'expires_at' => ['type'=>'DATETIME', 'null'=>true],
        ]);


        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('key');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('api_keys', true);
    }

    public function down()
    {
        $this->forge->dropTable('api_keys', true);
    }
}
