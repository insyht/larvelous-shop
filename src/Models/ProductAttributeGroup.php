<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeGroup extends Model
{
    public $timestamps = false;
    protected $fillable = ['language_id', 'title', 'order'];

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_attribute_group_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
