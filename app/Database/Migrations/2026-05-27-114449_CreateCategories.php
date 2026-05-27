<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategories extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true, 'null' => false],
            'name' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('categories', true);
    }

    public function down()
    {
        $this->forge->dropTable('categories', true);
    }
}