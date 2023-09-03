<?php

namespace Insyht\LarvelousShop\Http\Controllers;

use Insyht\LarvelousShop\Helpers\WishlistHelper;
use Insyht\LarvelousShop\Models\Product;

class WishlistController extends BasePluginController
{
    public function addToWishlist(): void
    {
        $productId = request()->post('productId');
        if ($productId === null) {
            return;
        }

        $productId = (int) $productId;
        $product = Product::find($productId);
        if ($product === null) {
            return;
        }

        app(WishlistHelper::class)->addToWishlist($product);
    }
}
