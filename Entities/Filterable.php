<?php

namespace Insyht\LarvelousShop\Entities;

use Illuminate\Support\Facades\URL;
use Insyht\LarvelousShop\Helpers\FilterHelper;
use Insyht\LarvelousShop\Models\ProductAttribute;

class Filterable
{
    public string $name;
    public string $template;

    protected $sessionKey;
    protected $active = false;

    public function __construct(
        public ProductAttribute $attribute,
        public string $value
    ) {
        $this->name = $this->attribute->title;
        $this->template = $this->attribute->productAttributeType->template;
        $this->sessionKey = URL::current() . '#' . $this->name;
        $this->active = $this->isActive();
    }

    public function isRanged(): bool
    {
        return $this->attribute->productAttributeType->is_ranged;
    }

    public function getUnit(): string
    {
        return $this->attribute->unit;
    }

    public function isActive(): bool
    {
        return app(FilterHelper::class)->isFilterableActive($this);
    }
}
