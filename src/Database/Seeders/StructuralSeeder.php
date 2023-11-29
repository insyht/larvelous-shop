<?php

namespace Insyht\LarvelousShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\Larvelous\Models\Template;

class StructuralSeeder extends Seeder
{
    public function run()
    {
        $template = new Template();
        $template->resource_id = 'iws_product';
        $template->label = 'Product template';
        $template->view = 'insyht-larvelous::base';
        $template->save();
    }
}
