<?php

namespace Insyht\LarvelousShop\Controllers;

use App\Http\Controllers\BasePluginControllerInterface;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Insyht\LarvelousShop\Models\ProductCategory;

class BaseController extends Controller implements BasePluginControllerInterface
{
    public function match(string $slug): bool
    {
        return ProductCategory::where('url', $slug)->first();
    }

    public function load(string $slug): Factory|View
    {
        $a = 0;
    }
}