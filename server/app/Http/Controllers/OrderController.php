<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Create an OrderProduct record for each product in $cart
        foreach ($cart as $product) {
            $priceByQuantity = Product::where('id', $product['id'])->first()->price_cost * $product['quantity'];

            OrderProduct::create([
                'order_id' => $newOrder->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $priceByQuantity,
            ]);
        }

        // Get the order_product_id, name, quantity and price of the products that belongs to an order
        $ordersProducts = DB::table('order_products')
                ->join('products', 'products.id', '=', 'order_products.product_id')
                ->where('order_products.order_id', '=', $newOrder->id)
                ->select('order_products.id AS order_product_id', 'products.name AS product', 'order_products.quantity', 'order_products.price')
                ->get()->all();

        $newOrder->products = $ordersProducts;
        
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
