<?php

namespace Insyht\LarvelousShop\Controllers;

use App\Http\Controllers\BasePluginControllerInterface;
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
        if ($slug === 'filter') {
            $found = true;
        } elseif (ProductCategory::where('url', $slug)->first()) {
            $found = true;
        } elseif (Product::where('url', $slug)->first()) {
            $found = true;
        }

        return $found;
    }

    public function load(string $slug): Factory|View|null
    {
        $return = null;
        switch (true) {
            case $slug === 'filter':
                if (request()->method() === 'POST') {
                    $return = app(FilterController::class)->apply();
                } elseif (request()->method() === 'DELETE') {
                    $return = app(FilterController::class)->remove();
                } else {
                    break;
                }
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
