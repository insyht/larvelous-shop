<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Insyht\Larvelous\Interfaces\MenuItemInterface;
use Insyht\Larvelous\Models\MenuItem;
use Insyht\LarvelousShop\Collections\ProductCollection;
use Insyht\LarvelousShop\Helpers\FilterHelper;
use ReflectionClass;

class ProductCategory extends Model implements MenuItemInterface
{
    public $timestamps = false;
    protected $fillable = ['title', 'introduction', 'url', 'image', 'parent_category', 'order', 'full_url'];

    public function getRouteKeyName(): string
    {
        return 'url';
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_category', 'id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_category', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    protected function url(): Attribute
    {
        return Attribute::make(function ($value) {
            return 'category/' . $value;
        });
    }

    public function hierarchicalProducts(bool $applyFilters = true): ProductCollection
    {
        $products = new ProductCollection();
        $products = $products->merge($this->products);
        foreach ($this->children as $child) {
            $products = $products->merge($child->hierarchicalProducts($applyFilters));
        }

        $products = $products->unique(function (Product $product) {
            return $product->id;
        });

        if ($applyFilters) {
            $products = app(FilterHelper::class)->applyFilters($products);
        }

        return $products;
    }

    public function getAvailableFilters(): Collection
    {
        $filters = [];
        foreach ($this->hierarchicalProducts(false) as $product) {
            foreach ($product->getFilterables() as $filterable) {
                if (!array_key_exists($filterable->name, $filters)) {
                    $filters[$filterable->name] = [
                        'template' => $filterable->template,
                        'values' => [],
                        'active' => false,
                        'unit' => $filterable->getUnit(),
                        'attributeId' => $filterable->attribute->id,
                        'chosenValues' => [],
                    ];
                    if ($filterable->isRanged()) {
                        $filters[$filterable->name]['min'] = null;
                        $filters[$filterable->name]['max'] = null;
                    }
                }
                $filters[$filterable->name]['values'][] = $filterable;
                if ($filterable->isActive()) {
                    $filters[$filterable->name]['active'] = true;
                }
                if ($filterable->isRanged()) {
                    $value = preg_replace('/[^0-9]/', '', $filterable->value);
                    if ($filters[$filterable->name]['min'] === null || $filters[$filterable->name]['min'] > $value) {
                        $filters[$filterable->name]['min'] = $value;
                    }
                    if ($filters[$filterable->name]['max'] === null || $filters[$filterable->name]['max'] < $value) {
                        $filters[$filterable->name]['max'] = $value;
                    }
                    $filters[$filterable->name]['chosenValues']['min'] = $filters[$filterable->name]['min'];
                    $filters[$filterable->name]['chosenValues']['max'] = $filters[$filterable->name]['max'];
                }
            }
        }

        $filterMapping = [];
        foreach ($filters as $filterName => $filter) {
            $filterMapping[$filter['attributeId']] = $filterName;
        }
        $activeFilters = app(FilterHelper::class)->getFilters();
        foreach ($activeFilters as $activeFilter) {
            if (!array_key_exists($activeFilter->attributeId, $filterMapping)) {
                continue;
            }
            $filterName = $filterMapping[$activeFilter->attributeId];
            if ($activeFilter->isRanged()) {
                if (empty($filters[$filterName]['chosenValues']['min'])) {
                    $filters[$filterName]['chosenValues']['min'] = $filters[$filterName]['min'];
                }
                if (empty($filters[$filterName]['chosenValues']['max'])) {
                    $filters[$filterName]['chosenValues']['max'] = $filters[$filterName]['max'];
                }
                $currentMin = $filters[$filterName]['chosenValues']['min'];
                $currentMax = $filters[$filterName]['chosenValues']['max'];
                if ($currentMin < $activeFilter->value) {
                    $filters[$filterName]['chosenValues']['min'] = $activeFilter->value;
                } elseif ($currentMax > $activeFilter->value) {
                    $filters[$filterName]['chosenValues']['max'] = $activeFilter->value;
                }
            } else {
                $filters[$filterName]['chosenValues'][] = $activeFilter->value;
            }
        }

        foreach ($filters as $index => $filter) {
            if (!empty($filter['chosenValues']['min']) && !empty($filter['chosenValues']['max'])) {
                if ($filter['chosenValues']['min'] > $filter['chosenValues']['max']) {
                    $realMin = $filter['chosenValues']['max'];
                    $realMax = $filter['chosenValues']['min'];
                    $filters[$index]['chosenValues']['min'] = $realMin;
                    $filters[$index]['chosenValues']['max'] = $realMax;
                }
            }
        }

        return collect($filters);
    }

    public function getFullUrlAttribute(): string
    {
        return env('APP_URL') . '/' . $this->url;
    }

    public function menuItems(): MorphMany
    {
        return $this->morphMany(MenuItem::class, 'menuitemable');
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTypeTranslation(): string
    {
        return __('insyht-larvelous-shop::translations.' . strtolower((new ReflectionClass($this))->getShortName()));
    }
}
