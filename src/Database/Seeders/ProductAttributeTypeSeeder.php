<?php

namespace Insyht\LarvelousShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\Larvelous\Models\Language;
use Insyht\LarvelousShop\Models\ProductAttributeType;

class ProductAttributeTypeSeeder extends Seeder
{
    public function run()
    {
        $language = Language::where('abbreviation', 'nl')->first();

        $attributeType = new ProductAttributeType();
        $attributeType->title = 'Tekst';
        $attributeType->template = 'text';
        $attributeType->language_id = $language->id;
        $attributeType->is_ranged = 0;
        $attributeType->save();

        $attributeType = new ProductAttributeType();
        $attributeType->title = 'Bereik';
        $attributeType->template = 'range';
        $attributeType->language_id = $language->id;
        $attributeType->is_ranged = 1;
        $attributeType->save();
    }
}
