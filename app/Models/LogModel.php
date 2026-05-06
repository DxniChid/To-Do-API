<?php

namespace App\Models;

use CodeIgniter\Model; 

class LogModel extends Model
{
    protected $table = 'logs';
    protected $allowedFields = [
        'method', 'endpoint', 'status', 'api_key'
    ];
}