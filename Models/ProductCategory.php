<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function children()
    {
        return $this->hasMany(static::class, 'id', 'parent_category')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_category', 'id');
    }
}
