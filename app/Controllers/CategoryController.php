<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CategoryModel;
use App\Models\TodoModel;

class CategoryController extends ResourceController
{
    protected $modelName = CategoryModel::class;
    protected $format = 'json';

    public function delete($id=null)
    {
        $todo = new TodoModel();

        if ($todo->where('category_id',$id)->countAllResults()>0) {
            return $this->fail('Category not empty',409);
        }

        return $this->respondDeleted($this->model->delete($id));
    }
}