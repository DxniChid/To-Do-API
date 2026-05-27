<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTodos extends Migration
{
    public function up() :void
    {
        $this->forge->addField([
            'id' => ['type' => 'INT','unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true, 'null' => false],
            'category_id' => ['type' => 'INT', 'unsigned' => true, 'null' => false],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'description' => ['type' => 'TEXT', 'null' => true],
            'completed' => ['type' => 'BOOLEAN', 'default' => false, 'null' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => false],
            'updated_at' => ['type' => 'DATETIME', 'null' => false],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('todos', true);
    }

    public function down()
    {
        $this->forge->dropTable('todos', true);
    }
}