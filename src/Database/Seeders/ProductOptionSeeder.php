<?php

namespace Insyht\LarvelousShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\Larvelous\Models\Language;
use Insyht\LarvelousShop\Models\ProductOption;

class ProductOptionSeeder extends Seeder
{
    public function run()
    {
        $language = Language::where('abbreviation', 'nl')->first();

        $option1 = new ProductOption();
        $option1->language_id = $language->id;
        $option1->title = 'Hoeveel kleuren kralen?';
        $option1->type = ProductOption::TYPE_RADIO;
        $option1->save();
        $option1->refresh();

        $option = new ProductOption();
        $option->language_id = $language->id;
        $option->title = 'Kleur kraal';
        $option->type = ProductOption::TYPE_RELATED;
        $option->relatedOption()->associate($option1);
        $option->save();

        $option = new ProductOption();
        $option->language_id = $language->id;
        $option->title = 'Luxe slotje';
        $option->type = ProductOption::TYPE_BOOL;
        $option->save();

        $option = new ProductOption();
        $option->language_id = $language->id;
        $option->title = 'Naam';
        $option->type = ProductOption::TYPE_TEXT;
        $option->save();
    }
}
