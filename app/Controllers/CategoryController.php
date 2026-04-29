<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->todos()->count() > 0) {
            return response()->json([
                'error' => 'Category not empty'
            ], 409);
        }

        $category->delete();

        return response()->json(['message' => 'deleted']);
    }
}

