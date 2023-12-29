<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProducts(Request $request)
    {
        $paginateBy = intval($request->input('paginateBy')) ?: 10;
        $paginated  = Product::paginate($paginateBy);
        return response()->json($paginated);
    }

    public function getProductsByCategory(Request $request, $category)
    {
        $productsByCategory = Category::where('name', $category)->first()->products->all();
        dd($productsByCategory);
        return response()->json([
            'products' => $productsByCategory
        ]);
    }

    public function getProductsByBrand(Request $request, $brand)
    {
        $productsByBrand = Brand::where('name', $brand)->first()->products->all();
        dd($productsByBrand);
        return response()->json([
            'products' => $productsByBrand
        ]);
    }

    public function getProductsByFilters(Request $request)
    {
        $filtersFromUrl = $request->collect()->all();

        // CHECK IF THERE ARE FILTERS ON THE URL
        if (empty($filtersFromUrl)) {
            return response()->json([
                'message' => "Send at least one filter (brand or category) on the query params. Returned all products",
                "products" => Product::all()
            ]);
        }

        $brandFounded = null;
        $categoryFounded = null;

        // CHEACK IF THE FILTERS EXISTS AND ARE VALIDS
        if (isset($filtersFromUrl['brand'])) {
            $brandFounded = Brand::where('name', $filtersFromUrl['brand'])->first();
        }
        if (isset($filtersFromUrl['category'])) {
            $categoryFounded = Category::where('name', $filtersFromUrl['category'])->first();
        }

        // Clean the null filters (when the category or brand no exist)
        $sanitizedFilters = array_filter(
            // Map of the valid filters E.g: [ ['brand_id', '=', '1'] ]
            array_map(
                function ($recordFounded, $filterFromUrl) {
                    if (!isset($recordFounded)) {
                        return;
                    }
                    return array_values(["$filterFromUrl" . "_id", "=", "$recordFounded->id"]);
                },
                array_filter([$brandFounded, $categoryFounded]),
                array_keys($filtersFromUrl)
            )
        );

        // If the filters after the sanitize are empty...
        if( empty($sanitizedFilters) ){
            return response()->json([
                'message' => "Filters specified may not exist or can't be applied. Returned all products",
                'products' => Product::all(),
            ]);
        }

        $filteredProducts = Product::where($sanitizedFilters)->get();

        return response()->json([
            'message' => "Filtered products",
            'products' => $filteredProducts,
        ]);
    }
}
