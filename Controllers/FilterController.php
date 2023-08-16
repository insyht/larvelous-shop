<?php

namespace Insyht\LarvelousShop\Controllers;

use App\Http\Controllers\AbstractPluginController;
use Insyht\LarvelousShop\Entities\Filter;
use Insyht\LarvelousShop\Helpers\FilterHelper;

class FilterController extends AbstractPluginController
{
    public function apply(): void
    {
        foreach (request()->query() as $attributeId => $filterValue) {
            if (is_array($filterValue)) {
                $firstIsLower = $filterValue[0] < $filterValue[1];
                app(FilterHelper::class)->setFilter(new Filter($attributeId, $filterValue[0]), $firstIsLower);
                app(FilterHelper::class)->setFilter(new Filter($attributeId, $filterValue[1]), !$firstIsLower);
            } else {
                app(FilterHelper::class)->setFilter(new Filter($attributeId, $filterValue));
            }
        }

        die(url()->previous());
    }

    public function remove(): void
    {
        foreach (request()->query() as $attributeId => $filterValue) {
            app(FilterHelper::class)->unsetFilter(new Filter($attributeId, ''));
        }

        die(url()->previous());
    }
}
