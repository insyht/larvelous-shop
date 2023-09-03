<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public $timestamps = false;
    protected $fillable = ['product_id', 'image', 'order'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
