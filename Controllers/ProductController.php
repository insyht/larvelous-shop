<?php

namespace Insyht\LarvelousShop\Controllers;

use App\Http\Controllers\AbstractPluginController;
use Illuminate\Contracts\View\View;
use Insyht\LarvelousShop\Models\Product;

class ProductController extends AbstractPluginController
{
    public function show(Product $product): View
    {
        $jsIncludes = [
            asset('js/insyht/larvelous-shop/product_options.js'),
            asset('js/insyht/larvelous-shop/cart.js'),
            asset('js/insyht/larvelous-shop/wishlist.js'),
        ];

        return $this->decoratedView(
            $this->getPluginViewPath() . '.product',
            [
                'product' => $product,
                'breadcrumb' => $product->title,
                'jsIncludes' => $jsIncludes,
            ]
        );
    }
}
