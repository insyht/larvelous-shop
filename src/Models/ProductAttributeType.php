<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeType extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'template', 'is_ranged'];
    protected $casts = ['is_ranged', 'boolean'];
}
