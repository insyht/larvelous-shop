<?php

namespace Insyht\LarvelousShop\Http\Controllers;

use Insyht\Larvelous\Http\Controllers\AbstractPluginController;

class BasePluginController extends AbstractPluginController
{
    protected function getBaseViteIncludes(): array
    {
        return [
            [
                'hotFile' => 'vendor/insyht/larvelous-shop/larvelous-shop.hot',
                'buildDirectory' => 'vendor/insyht/larvelous-shop',
                'entryPoints' => ['resources/js/app.js'],
            ],
        ];
    }

    protected function getJsIncludes(): array
    {
        return [
            asset('vendor/insyht/larvelous-shop/js/filters.js'),
            asset('vendor/insyht/larvelous-shop/js/product_options.js'),
            asset('vendor/insyht/larvelous-shop/js/cart.js'),
            asset('vendor/insyht/larvelous-shop/js/wishlist.js'),
        ];
    }
}
