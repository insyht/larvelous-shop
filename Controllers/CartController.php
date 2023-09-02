<?php

namespace Insyht\LarvelousShop\Controllers;

use App\Http\Controllers\AbstractPluginController;
use Insyht\LarvelousShop\Helpers\CartHelper;
use Insyht\LarvelousShop\Models\Product;

class CartController extends AbstractPluginController
{
    public function addToCart(): void
    {
        $productId = request()->post('productId');
        $amount = request()->post('amount');
        if ($productId === null || $amount === null) {
            return;
        }

        $amount = (int) $amount;
        $productId = (int) $productId;
        $product = Product::find($productId);
        if ($product === null) {
            return;
        }

        app(CartHelper::class)->addToCart($product, $amount);
    }
}
