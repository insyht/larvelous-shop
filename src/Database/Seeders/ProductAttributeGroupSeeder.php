<?php

namespace Insyht\LarvelousShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\Larvelous\Models\Language;
use Insyht\LarvelousShop\Models\ProductAttributeGroup;

class ProductAttributeGroupSeeder extends Seeder
{
    public function run()
    {
        $attributeGroup = new ProductAttributeGroup();
        $attributeGroup->title = 'Spenen';
        $attributeGroup->order = 1;
        $attributeGroup->language_id = Language::where('abbreviation', 'nl')->first()->id;
        $attributeGroup->save();
    }
}
