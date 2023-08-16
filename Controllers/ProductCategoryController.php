<?php

namespace Insyht\LarvelousShop\Controllers;

use App\Http\Controllers\AbstractPluginController;
use Illuminate\Contracts\View\View;
use Insyht\LarvelousShop\Models\ProductCategory;

class ProductCategoryController extends AbstractPluginController
{
    public function show(ProductCategory $productCategory): View
    {
        $jsIncludes = [
            asset('js/insyht/larvelous-shop/filters.js'),
        ];
        $breadcrumb = $productCategory->title;
        $category = $productCategory;
        while ($category->parent) {
            $category = $category->parent;
            $breadcrumb = sprintf('<a href="%s">%s</a> / %s', $category->full_url, $category->title, $breadcrumb);
        }

        $products = $productCategory->hierarchicalProducts();

        return $this->decoratedView(
            $this->getPluginViewPath() . '.product-category',
            [
                'productCategory' => $productCategory,
                'products' => $products,
                'breadcrumb' => $breadcrumb,
                'jsIncludes' => $jsIncludes
            ]
        );
    }
}
