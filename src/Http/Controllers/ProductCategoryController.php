<?php

namespace Insyht\LarvelousShop\Http\Controllers;

use Illuminate\Contracts\View\View;
use Insyht\LarvelousShop\Models\ProductCategory;

class ProductCategoryController extends BasePluginController
{
    public function show(ProductCategory $productCategory): View
    {
        $breadcrumb = $productCategory->title;
        $category = $productCategory;
        while ($category->parent) {
            $category = $category->parent;
            $breadcrumb = sprintf('<a href="%s">%s</a> / %s', $category->full_url, $category->title, $breadcrumb);
        }

        $products = $productCategory->hierarchicalProducts();
        $products = $this->paginateCollection($products, 8); // todo Make the amount of items per page configurable

        return $this->decoratedView(
            'larvelous-shop.product-category',
            [
                'productCategory' => $productCategory,
                'products' => $products,
                'breadcrumb' => $breadcrumb,
                'jsIncludes' => $this->getJsIncludes(),
                'viteIncludes' => $this->getBaseViteIncludes(),
            ]
        );
    }
}
