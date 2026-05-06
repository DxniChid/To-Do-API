<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{
   protected $table = 'todos';
    protected $allowedFields = [
        'title','description','completed','category_id'
    ];
    protected $useTimestamps = true;
}