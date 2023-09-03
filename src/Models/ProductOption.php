<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    public const TYPE_RADIO = 'RADIO';
    public const TYPE_BOOL = 'BOOL';
    public const TYPE_TEXT = 'TEXT';
    public const TYPE_RELATED = 'RELATED';

    public $timestamps = false;
    protected $fillable = [
        'language_id',
        'title',
        'type',
        'related_option_id',
    ];

    public function choices()
    {
        return $this->hasMany(ProductOptionChoice::class)->orderBy('order');
    }

    public function settings()
    {
        return $this->belongsToMany(ProductOptionSetting::class)->withPivot('value');
    }

    public function hasSetting(string $name): bool
    {
        return $this->settings()->where('name', $name)->exists();
    }

    public function getSettingValue(string $name): ?string
    {
        return $this->settings()->where('name', $name)->first()?->pivot->value;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function relatedOption()
    {
        return $this->belongsTo(static::class, 'related_option_id');
    }
}
