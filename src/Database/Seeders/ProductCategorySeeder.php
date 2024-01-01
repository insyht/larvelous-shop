<?php

namespace Insyht\LarvelousShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\Larvelous\Models\Menu;
use Insyht\Larvelous\Models\MenuItem;
use Insyht\LarvelousShop\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $category = new ProductCategory();
        $category->title = 'Categorie';
        $category->introduction = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper, purus a volutpat euismod, risus orci ultrices turpis, ut ornare elit quam tristique felis. Sed ac mauris efficitur, tempor ante ac, venenatis magna. Vestibulum eget faucibus mauris, et condimentum nibh. Duis gravida augue id pharetra semper. Cras imperdiet, purus non imperdiet ultricies, odio odio venenatis felis, vitae tempor tortor turpis eu turpis.';
        $category->url = 'categorie';
        $category->image = 'storage/images/placeholder.jpg';
        $category->order = 1;
        $category->save();
        $category->refresh();

        $category2 = new ProductCategory();
        $category2->title = 'Subcategorie';
        $category2->introduction = '';
        $category2->url = 'subcategorie';
        $category2->image = 'storage/images/placeholder.jpg';
        $category2->order = 1;
        $category2->parent()->associate($category);
        $category2->save();
        $category2->refresh();

        $item = new MenuItem();
        $item->item_id = $category->id;
        $item->item_type = ProductCategory::class;
        $item->ordering = 4;
        Menu::where('position', 'main_menu')->first()->items()->save($item);

        $item = new MenuItem();
        $item->item_id = $category2->id;
        $item->item_type = ProductCategory::class;
        $item->ordering = 5;
        Menu::where('position', 'main_menu')->first()->items()->save($item);
    }
}
