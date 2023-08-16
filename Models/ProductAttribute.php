<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title', 'order', 'unit'];

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
