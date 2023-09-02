<?php

namespace Insyht\LarvelousShop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductParagraph extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'title',
        'text',
        'image',
        'url',
        'url_text',
        'image_position',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
