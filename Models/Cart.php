<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'session_id',
        'payment_method_id',
        'shipping_method_id',
        'payment_id',
        'customer_id',
        'shipment_id',
        'remarks',
    ];

    public function addProduct(Product $product, int $amount): void
    {
        // todo
    }
}
