<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOptionChoice extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_option_id',
        'title',
        'order',
    ];

    public function productOption()
    {
        return $this->belongsTo(ProductOption::class);
    }
}
