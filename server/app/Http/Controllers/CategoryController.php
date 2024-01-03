<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories(Request $request)
    {
        $paginateBy = intval($request->input('paginateBy')) ?: 10;
        $paginated  = Category::paginate($paginateBy);
        
        return response()->json($paginated);
    }
}
