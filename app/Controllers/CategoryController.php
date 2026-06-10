<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CategoryModel;
use App\Models\TodoModel;

class CategoryController extends ResourceController
{
    protected $modelName = CategoryModel::class;
    protected $format = 'json';
    public function index()
{
    return $this->respond($this->model->findAll());
}


public function create()
{
    $data = $this->request->getJSON(true);
    
    // log_message(...) moved here if you still want it

    if (!isset($data['name']) || strlen(trim($data['name'])) < 2) {
        return $this->failValidationErrors([
            'name' => 'Name required (min 2 chars)'
        ]);
    }

    $data['name'] = trim(strip_tags($data['name']));

    // 1. Capture the ID returned by insert()
    $id = $this->model->insert($data);

    // 2. Return the ID in the response so your test can find it
    return $this->respondCreated([
        'id' => $id,
        'message' => 'Kategorie erstellt'
    ]);
}
    public function delete($id=null)
    {
        if (!is_numeric($id)) {
            return $this->failValidationErrors([
            'id' => 'ungültige ID'
        ]);
        }
        if (! $this->model->find($id)) {
            return $this->failNotFound('Kategorie nicht gefunden');
        }
        $todo = new TodoModel();

        if ($todo->where('category_id',$id)->countAllResults()>0) {
            return $this->fail('Kategorie nicht leer',409);
        }

        $this->model->delete($id);

        return $this->respondDeleted([
             'message' => 'Kategorie erfolgreich gelöscht'
        ]);
    }
}