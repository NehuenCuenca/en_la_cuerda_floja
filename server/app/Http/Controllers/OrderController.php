<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createNewOrder(Request $request)
    {
        $cart = $request->input('cart');
        
        // search if cart given has non existent products
        if( Self::hasNonExistentProduct($cart) ){
            return response()->json([
                "message" => "Some product in cart doesnt exist in the database, try again. Order cancelled."
            ], 400);
        }

        $totalPriceOfCart = Self::calculateTotalPriceCart($cart);
        
        // Create the new order 
        $newOrder = Order::create([
            'user_id' => $request->user()->id,
            'status' => 'placed',
            'total_price' => $totalPriceOfCart,
        ]);

        // Associate the products to an order
        collect($cart)->each(function ($product) use ($newOrder) {
            $newOrder->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        });

        $newOrder->products->all();
        
        return response()->json([
            "message" => "The order was succesfull",
            "order" => $newOrder,
        ]);
    }

    
    public function hasNonExistentProduct(Array $products) {
        $productNotFounded = false;

        // In a loop, verify that exist such a product.
        foreach ($products as $product) {
            $productFromDB = Product::where('id', $product['id'])->first();

            // if not exist, stop the loop
            if( !isset($productFromDB) ){ 
                $productNotFounded = true;
                break;
            }
        }

        return $productNotFounded;
    }

    public function calculateTotalPriceCart(Array $products){
        return array_reduce($products, function ($acc, $product) {
            $productFromDB = Product::where('id', $product['id'])->first();
            return $acc + ($productFromDB->price_cost * $product['quantity']);
        }, 0);
    }
}
