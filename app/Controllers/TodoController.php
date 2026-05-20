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

        $builder = $this->model;

        // FILTER
        if ($this->request->getGet('category_id')) {
            $builder = $builder->where(...)(
                'category_id',
                $this->request->getGet('category_id')
            );
        }

        // SORT
        if ($this->request->getGet('order_by') === 'date') {
            $builder = $builder->orderBy('created_at', 'DESC');
        }

        return $this->respond($builder->paginate($limit));
    }

    public function create()
    {
        $model = new TodoModel();

        $data = $this->request->getJSON(true);

    if (! $this->validate([
            'title' => 'required|min_length[3]',
            'category_id' => 'required|integer'
    ])) {
    return $this->failValidationErrors($this->validator->getErrors());
}
        $data['title'] = trim($data['title']);
        $data['category_id'] = (int) $data['category_id'];

        $model->insert($data);

        return $this->respondCreated($data);
    }

    // PUT /todos/{id}
    public function update($id = null)
    {
        if (!is_numeric($id)) {
        return $this->failValidationErrors([
        'id' => 'Invalid ID'
        ]);
    }  
        $model = new TodoModel();

        $todo = $model->find($id);

        if (!$todo) {
            return $this->failNotFound('Todo not found');
        }

        $data = $this->request->getJSON(true);

        if (! $this->validate([
            'title' => 'permit_empty|min_length[3]',
            'category_id' => 'permit_empty|integer'
    ])) {

    return $this->failValidationErrors($this->validator->getErrors());
}
        

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