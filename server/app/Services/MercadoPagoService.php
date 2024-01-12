<?php

namespace App\Services;

use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;

class MercadoPagoService
{
    public function __construct()
    {
        SDK::setAccessToken(config('mercadopago.access_token'));
    }

    public function createPreference($order)
    {
        $preference = new Preference();

        $items = array_map(function($product) { 
            $item = new Item();

            $item->title = $product->product;
            $item->quantity = $product->pivot->quantity;
            $item->unit_price = $product->price_cost;

            return $item;
        }, $order->products->all());

        $preference->items = $items;
        $preference->external_reference = $order->id;
        $preference->save();

        return $preference;
    }
}
