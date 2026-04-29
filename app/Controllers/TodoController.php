<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TodoController extends BaseController
{
    public function index(Request $request)
    {
        $query = Todo::query();

        // Filtering
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Sorting
        if ($request->order_by === 'date') {
            $query->orderBy('created_at', 'desc');
        }

    
        $limit = $request->limit ?? 10;

        return response()->json(
            $query->paginate($limit)
        );
    }
        public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'category_id' => 'required|exists:categories,id'
        ]);

        return Todo::create($request->all());
    }
        public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);

        $todo->update($request->only([
            'title',
            'description',
            'completed'
        ]));

        return $todo;
    }

        public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json(['message' => 'deleted']);
    }
}

