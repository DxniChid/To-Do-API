<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TodoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Einkaufen',
                'description' => 'Im Lidl einkaufen gehen',
                'completed' => false,
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Fitness',
                'description' => '30 Minuten joggen',
                'completed' => true,
                'category_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Milch kaufen',
                'description' => '2 Liter Milch holen',
                'completed' => false,
                'category_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('todos')->insertBatch($data);
    }
}