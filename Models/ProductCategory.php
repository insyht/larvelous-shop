<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'product_category';
    protected $fillable = ['title', 'introduction', 'url', 'image', 'parent_category', 'order', 'full_url'];

    public function children()
    {
        return $this->hasMany(static::class, 'parent_category', 'id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'id', 'parent_category');
    }

//    public function products()
//    {
//        return $this->belongsto(Product:class);
//    }

    public function getAvailableFilters(): array
    {
        $filters = [];

//        foreach ($this->products as $product) {
//            if ($product->getFilterables() as $filterable) {
//                if (!array_key_exists($filterable->name, $filters)) {
//                    $filters[$filterable->name] = [$filterable->value];
//                } else {
//                    $filters[$filterable->name][] = $filterable->value;
//                }
//            }
//        }

        return $filters;
    }

    public function getFullUrlAttribute(): string
    {
        return env('APP_URL') . '/' . $this->url;
    }
}
