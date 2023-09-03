<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'order', 'unit', 'product_attribute_group_id', 'product_attribute_type_id'];

    public function products()
    {
        return $this->through('productAttributeGroup')->has('products');
    }

    public function productAttributeGroup()
    {
        return $this->belongsTo(ProductAttributeGroup::class);
    }

    public function productAttributeType()
    {
        return $this->belongsTo(ProductAttributeType::class);
    }
}
