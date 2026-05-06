<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CategoryModel;
use App\Models\TodoModel;

class CategoryController extends ResourceController
{
    protected $modelName = CategoryModel::class;
    protected $format = 'json';

    public function delete($id = null)
    {
        $categoryModel = new CategoryModel();
        $todoModel = new TodoModel();

        $category = $categoryModel->find($id);

        if (!$category) {
            return $this->failNotFound('Category not found');
        }

        $count = $todoModel->where('category_id', $id)->countAllResults();

        if ($count > 0) {
            return $this->fail('Category not empty', 409);
        }

        $categoryModel->delete($id);

        return $this->respondDeleted(['message' => 'deleted']);
    }
}