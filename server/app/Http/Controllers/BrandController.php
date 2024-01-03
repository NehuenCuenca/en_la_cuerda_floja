<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function getAllBrands(Request $request)
    {
        $paginateBy = intval($request->input('paginateBy')) ?: 10;
        $paginated  = Brand::paginate($paginateBy);
        
        return response()->json($paginated);
    }
}
