<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TodoModel;

class TodoController extends ResourceController
{
    protected $modelName = TodoModel::class;
    protected $format = 'json';

    // GET /todos
    public function index()
    {
        $model = new TodoModel();

        $limit = $this->request->getGet('limit') ?? 10;

        $query = $model;

        // FILTER
        if ($this->request->getGet('category_id')) {
            $query = $query->where(
                'category_id',
                $this->request->getGet('category_id')
            );
        }

        // SORT
        if ($this->request->getGet('order_by') === 'date') {
            $query = $query->orderBy('created_at', 'DESC');
        }

        return $this->respond(
            $query->paginate($limit)
        );
    }

    public function create()
    {
        $model = new TodoModel();

        $data = $this->request->getJSON(true);

        if (!isset($data['title']) || strlen($data['title']) < 3) {
            return $this->failValidationErrors('Title must be at least 3 characters');
        }

        if (!isset($data['category_id'])) {
            return $this->failValidationErrors('category_id required');
        }

        $model->insert($data);

        return $this->respondCreated($data);
    }

    // PUT /todos/{id}
    public function update($id = null)
    {
        $model = new TodoModel();

        $todo = $model->find($id);

        if (!$todo) {
            return $this->failNotFound('Todo not found');
        }

        $data = $this->request->getJSON(true);

        $model->update($id, $data);

        return $this->respond(['message' => 'updated']);
    }

    // DELETE /todos/{id}
    public function delete($id = null)
    {
        $model = new TodoModel();

        $todo = $model->find($id);

        if (!$todo) {
            return $this->failNotFound('Todo not found');
        }

        $model->delete($id);

        return $this->respondDeleted(['message' => 'deleted']);
    }
}