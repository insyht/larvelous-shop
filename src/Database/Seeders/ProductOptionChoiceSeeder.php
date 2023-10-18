<?php

namespace Insyht\LarvelousShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\LarvelousShop\Models\ProductOption;
use Insyht\LarvelousShop\Models\ProductOptionChoice;

class ProductOptionChoiceSeeder extends Seeder
{
    public function run()
    {
        $choiceAmountColors = ProductOption::where('title', 'Hoeveel kleuren kralen?')->first();
        $choiceBeadColor = ProductOption::where('title', 'Kleur kraal')->first();

        $choice = new ProductOptionChoice();
        $choice->title = '1';
        $choice->order = 1;
        $choice->productOption()->associate($choiceAmountColors);
        $choice->save();
        $choice = new ProductOptionChoice();
        $choice->title = '2';
        $choice->order = 2;
        $choice->productOption()->associate($choiceAmountColors);
        $choice->save();
        $choice = new ProductOptionChoice();
        $choice->title = '3';
        $choice->order = 3;
        $choice->productOption()->associate($choiceAmountColors);
        $choice->save();
        $choice = new ProductOptionChoice();
        $choice->title = '4';
        $choice->order = 4;
        $choice->productOption()->associate($choiceAmountColors);
        $choice->save();
        $choice = new ProductOptionChoice();
        $choice->title = '5';
        $choice->order = 5;
        $choice->productOption()->associate($choiceAmountColors);
        $choice->save();

        $choice = new ProductOptionChoice();
        $choice->title = 'Transparant wit';
        $choice->order = 1;
        $choice->productOption()->associate($choiceBeadColor);
        $choice->save();
        $choice = new ProductOptionChoice();
        $choice->title = 'Transparant blauw';
        $choice->order = 2;
        $choice->productOption()->associate($choiceBeadColor);
        $choice->save();
        $choice = new ProductOptionChoice();
        $choice->title = 'Wit';
        $choice->order = 3;
        $choice->productOption()->associate($choiceBeadColor);
        $choice->save();
    }
}
