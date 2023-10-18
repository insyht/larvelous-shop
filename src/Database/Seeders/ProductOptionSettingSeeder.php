<?php

namespace Insyht\LarvelousShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\LarvelousShop\Models\ProductOption;
use Insyht\LarvelousShop\Models\ProductOptionSetting;

class ProductOptionSettingSeeder extends Seeder
{
    public function run()
    {
        $option = ProductOption::where('title', 'Naam')->first();

        $setting = new ProductOptionSetting();
        $setting->name = 'maxlength';
        $setting->save();
        $setting->productOptions()->attach([$option->id => ['value' => '10']]);
        $setting->save();
    }
}
