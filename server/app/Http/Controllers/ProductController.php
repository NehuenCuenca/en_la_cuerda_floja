<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return response()->json([
            'products' => $productsByCategory
        ]);
    }

    public function getProductsByBrand(Request $request, $brand)
    {
        $productsByBrand = Brand::where('name', $brand)->first()->products->all();

        return response()->json([
            'products' => $productsByBrand
        ]);
    }

    public function getProductsByFilters(Request $request)
    {
        $filtersFromUrl = $request->except(['paginateBy', 'page', 'productToSearch']); 
        $paginateBy = intval($request->input('paginateBy')) ?: 10;

        $brandFounded = null;
        $categoryFounded = null;

        // CHECK IF BRAND AND CATEGORY FILTERS EXISTS AND ARE VALIDS
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

        // IF FILTER productToSearch EXIST, ADD TO sanitizedFilters
        $productToSearch = $request->input('productToSearch');
        if( isset($productToSearch) ){
            array_push($sanitizedFilters, ['name', 'like', '%'.$productToSearch.'%']);
        } 

        // If the filters after the sanitize are empty...
        if( empty($sanitizedFilters) ){
            return response()->json([
                'message' => "Filters specified may not exist or can't be applied.",
            ], 400);
        } 
       
        $filteredProducts = Product::where($sanitizedFilters)->paginate($paginateBy);

        return response()->json( $filteredProducts );
    }

    public function getProductById(Request $request, int $id)
    { 
        $productFounded = DB::table('products')
                            ->join('brands', 'products.brand_id', '=', 'brands.id')
                            ->join('categories', 'products.brand_id', '=', 'categories.id')
                            ->where('products.id', '=', $id)
                            ->select('products.id', 'brands.name AS brand', 'categories.name AS category', 'products.name', 'products.price_cost', 'products.description')
                            ->first(); 
                             
        if( !isset($productFounded) ){
            return response()->json([
                'message' => "The product with id '$id' can't be found"
            ], 400);
        }
        
        return response()->json([
            'message' => "Product founded",
            'product' => $productFounded
        ]);
    }
}
