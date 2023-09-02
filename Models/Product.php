<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Insyht\LarvelousShop\Entities\Filterable;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
        'price',
        'discount_price',
        'introduction_title',
        'introduction_text',
        'url',
        'main_image',
    ];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function productAttributeGroup()
    {
        return $this->belongsTo(ProductAttributeGroup::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function paragraphs()
    {
        return $this->hasMany(ProductParagraph::class);
    }

    public function options()
    {
        return $this->belongsToMany(ProductOption::class)->orderBy('order');
    }

    public function attributes()
    {
        $attributes = collect();

        $group = $this->productAttributeGroup()->first();
        if ($group) {
            $attributes = $group->attributes()->get();
        }

        return $attributes;
    }

    public function related(): BelongsToMany
    {
        return $this->belongsToMany(static::class, 'product_related', 'product_id', 'related_id');
    }

    public function hasAttribute(ProductAttribute $attribute): bool
    {
        return $this->attributes()->contains($attribute);
    }

    public function attributeValue(ProductAttribute $attribute): string
    {
        $value = ProductAttributeValue::where('product_id', $this->id)
                                      ->where('product_attribute_id', $attribute->id)
                                      ->first()?->value;

        return $value ?? '';
    }

    public function getFilterables(): Collection
    {
        $filterables = collect();
        foreach ($this->attributes() as $attribute) {
            $filterable = new Filterable(
                $attribute,
                $this->attributeValue($attribute)
            );
            $filterables = $filterables->add($filterable);
        }

        $filterables = $filterables->unique(function (Filterable $filterable) {
            return $filterable->name . '=' . $filterable->value;
        });

        return $filterables;
    }

    public function getFullUrlAttribute(): string
    {
        return env('APP_URL') . '/' . $this->url;
    }

    protected function price(): Attribute
    {
        return Attribute::make(function ($value) {
            return number_format($value, 2, ',', '.');
        });
    }

    protected function discountPrice(): Attribute
    {
        return Attribute::make(function ($value) {
            return number_format($value, 2, ',', '.');
        });
    }
}
