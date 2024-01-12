<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Services\MercadoPagoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct(
        private MercadoPagoService $mercadoPagoService
    ) {}
    
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
                'price' => round($priceByQuantity, 2),
            ]);
        }

        // add the relations of the products to the instance
        $newOrder->products;
        
        // integrating mercado pago service 
        $preference = $this->mercadoPagoService->createPreference($newOrder);
        
        return response()->json([
            "message" => "The order was succesfull",
            'init_point' => $preference->init_point,
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
            $acc += ($productFromDB->price_cost * $product['quantity']);
            return round($acc, 2);
        }, 0);
    }
}
