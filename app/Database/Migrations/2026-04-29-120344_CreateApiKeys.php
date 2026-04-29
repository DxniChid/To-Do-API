<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApiKeys extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'key' => ['type' => 'VARCHAR', 'constraint' => 255],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('api_keys');
    }

    public function down()
    {
        $this->forge->dropTable('api_keys');
    }
}