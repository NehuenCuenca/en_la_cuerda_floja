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
            $item->quantity = $product->quantity;
            $item->unit_price = $product->unit_price;

            return $item;
        }, $order->products);

        $preference->items = $items;
        $preference->external_reference = $order->id;
        $preference->save();

        return $preference;
    }
}
