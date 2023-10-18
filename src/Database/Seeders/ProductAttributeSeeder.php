<?php

namespace Insyht\LarvelousShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\Larvelous\Models\Language;
use Insyht\LarvelousShop\Models\ProductAttribute;
use Insyht\LarvelousShop\Models\ProductAttributeGroup;
use Insyht\LarvelousShop\Models\ProductAttributeType;

class ProductAttributeSeeder extends Seeder
{
    public function run()
    {
        $attributeGroup = ProductAttributeGroup::where('title', 'Spenen')->first();
        $attributeTypeText = ProductAttributeType::where('title', 'Tekst')->first();
        $attributeTypeRange = ProductAttributeType::where('title', 'Bereik')->first();
        $language = Language::where('abbreviation', 'nl')->first();

        $productAttribute = new ProductAttribute();
        $productAttribute->language_id = $language->id;
        $productAttribute->title = 'Glow in the dark';
        $productAttribute->unit = '';
        $productAttribute->order = 1;
        $productAttribute->productAttributeGroup()->associate($attributeGroup);
        $productAttribute->productAttributeType()->associate($attributeTypeText);
        $productAttribute->save();

        $productAttribute = new ProductAttribute();
        $productAttribute->language_id = $language->id;
        $productAttribute->title = 'Maat';
        $productAttribute->unit = '';
        $productAttribute->order = 2;
        $productAttribute->productAttributeGroup()->associate($attributeGroup);
        $productAttribute->productAttributeType()->associate($attributeTypeRange);
        $productAttribute->save();

        $productAttribute = new ProductAttribute();
        $productAttribute->language_id = $language->id;
        $productAttribute->title = 'Kleur';
        $productAttribute->unit = '';
        $productAttribute->order = 3;
        $productAttribute->productAttributeGroup()->associate($attributeGroup);
        $productAttribute->productAttributeType()->associate($attributeTypeText);
        $productAttribute->save();

        $productAttribute = new ProductAttribute();
        $productAttribute->language_id = $language->id;
        $productAttribute->title = 'Lengte';
        $productAttribute->unit = 'cm';
        $productAttribute->order = 4;
        $productAttribute->productAttributeGroup()->associate($attributeGroup);
        $productAttribute->productAttributeType()->associate($attributeTypeRange);
        $productAttribute->save();

        $productAttribute = new ProductAttribute();
        $productAttribute->language_id = $language->id;
        $productAttribute->title = 'Merk';
        $productAttribute->unit = '';
        $productAttribute->order = 5;
        $productAttribute->productAttributeGroup()->associate($attributeGroup);
        $productAttribute->productAttributeType()->associate($attributeTypeText);
        $productAttribute->save();

    }
}
