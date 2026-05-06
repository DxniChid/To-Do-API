<?php

namespace App\Models;

use CodeIgniter\Model; 

class ApiKeyModel extends Model
{
    protected $table = 'api_keys';
    protected $allowedFields = ['key', 'name'];
}