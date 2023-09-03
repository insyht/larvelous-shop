<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOptionSetting extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany(ProductOption::class);
    }
}
