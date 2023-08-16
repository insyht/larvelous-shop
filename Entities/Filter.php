<?php

namespace Insyht\LarvelousShop\Entities;

use Insyht\LarvelousShop\Models\ProductAttribute;

class Filter
{
    protected ProductAttribute $attribute;

    public function __construct(
        public int $attributeId,
        public string $value
    ) {
        $this->attribute = ProductAttribute::find($this->attributeId);
    }

    public function isRanged(): bool
    {
        return $this->attribute->productAttributeType->is_ranged;
    }
}
