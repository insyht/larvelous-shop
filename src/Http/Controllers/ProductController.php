<?php

namespace Insyht\LarvelousShop\Http\Controllers;

use Illuminate\Contracts\View\View;
use Insyht\LarvelousShop\Models\Product;

class ProductController extends BasePluginController
{
    public function show(Product $product): View
    {
        if ($product->id === null) {
            abort(404);
        }

        return $this->decoratedView(
            'larvelous-shop.product',
            [
                'product' => $product,
                'breadcrumb' => $product->title,
                'jsIncludes' => $this->getJsIncludes(),
                'viteIncludes' => $this->getBaseViteIncludes(),
            ]
        );
    }
}
