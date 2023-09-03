<?php

namespace Insyht\LarvelousShop\Http\Controllers;

use Insyht\Larvelous\Http\Controllers\BasePluginControllerInterface;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Insyht\LarvelousShop\Models\Product;
use Insyht\LarvelousShop\Models\ProductCategory;

class BaseController extends Controller implements BasePluginControllerInterface
{
    public function match(string $slug): bool
    {
        $found = false;
        switch (true) {
            case $slug === 'filter':
            case !empty(ProductCategory::where('url', $slug)->first()):
            case !empty(Product::where('url', $slug)->first()):
            case $slug === 'add-to-cart':
            case $slug === 'add-to-wishlist':
                $found = true;
                break;
        }

        return $found;
    }

    public function load(string $slug): Factory|View|null
    {
        $return = null;
        switch (true) {
            case $slug === 'filter':
                if (request()->method() === 'POST') {
                    app(FilterController::class)->apply();
                } elseif (request()->method() === 'DELETE') {
                    app(FilterController::class)->remove();
                } else {
                    break;
                }
                break;
            case $slug === 'add-to-cart':
                app(CartController::class)->addToCart();
                break;
            case $slug === 'add-to-wishlist':
                app(WishlistController::class)->addToWishlist();
                break;
            case !empty(ProductCategory::where('url', $slug)->first()):
                $return = app(ProductCategoryController::class)->show(ProductCategory::where('url', $slug)->first());
                break;
            case !empty(Product::where('url', $slug)->first()):
                $return = app(ProductController::class)->show(Product::where('url', $slug)->first());
                break;
        }

        return $return;
    }
}
