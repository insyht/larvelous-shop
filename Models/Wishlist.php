<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'session_id',
    ];

    public function addProduct(Product $product): void
    {
        // todo
    }
}
