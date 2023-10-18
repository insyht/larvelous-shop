<?php

namespace Insyht\LarvelousShop\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProductAttributeGroupSeeder::class);
        $this->call(ProductAttributeTypeSeeder::class);
        $this->call(ProductAttributeSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductOptionSeeder::class);
        $this->call(ProductOptionChoiceSeeder::class);
        $this->call(ProductOptionSettingSeeder::class);

        $this->call(ProductSeeder::class);
    }
}
