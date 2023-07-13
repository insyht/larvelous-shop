<?php

namespace Insyht\LarvelousShop\Controllers;

use App\Http\Controllers\AbstractPluginController;
use Illuminate\Contracts\View\View;
use Insyht\LarvelousShop\Models\ProductCategory;

class ProductCategoryController extends AbstractPluginController
{
    public function show(ProductCategory $productCategory): View
    {
        return $this->decoratedView(
            $this->getPluginViewPath() . '.product-category',
            ['productCategory' => $productCategory]
        );
    }
}
