<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ApiKeySeeder extends Seeder
{
    public function run()
    {
        $this->db->table('api_keys')->insert([
            'key' => 'ABC123'
        ]);
    }
}