<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    public $timestamps = false;
    protected $fillable = ['value'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    public function productAttributeGroup()
    {
        return $this->productAttribute()->productAttributeGroup();
    }
}
