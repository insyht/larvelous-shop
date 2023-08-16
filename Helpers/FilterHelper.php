<?php

namespace Insyht\LarvelousShop\Helpers;

use Insyht\LarvelousShop\Collections\FilterCollection;
use Insyht\LarvelousShop\Collections\ProductCollection;
use Insyht\LarvelousShop\Entities\Filter;
use Insyht\LarvelousShop\Entities\Filterable;
use Insyht\LarvelousShop\Models\Product;
use Insyht\LarvelousShop\Models\ProductAttribute;

class FilterHelper
{
    public function setFilter(Filter $filter, bool $isLowerPartOfRange = true): bool
    {
        $filters = $this->getFilters();

        // Remove if the filter is a duplicate
        $filters = $filters->filter(function (Filter $currentFilter) use ($filter) {
            $notSameAttributeId = $currentFilter->attributeId !== $filter->attributeId;
            $sameAttributeId = $currentFilter->attributeId === $filter->attributeId;
            $sameAttributeIdButRanged = $sameAttributeId && $currentFilter->isRanged();

            return $notSameAttributeId || $sameAttributeIdButRanged;
        });

        // Replace if there are two of this filter; Add if there is one or less of this filter
        if ($filter->isRanged()) {
            $similarFilters = [];
            foreach ($filters as $index => $currentFilter) {
                if ($currentFilter->attributeId === $filter->attributeId) {
                    $similarFilters[$index] = $currentFilter->value;
                }
            }
            if (count($similarFilters) <= 1) {
                $filters->add($filter);
            } else {
                if ($isLowerPartOfRange) {
                    $indexToReplace = array_search(min($similarFilters), $similarFilters);
                } else {
                    $indexToReplace = array_search(max($similarFilters), $similarFilters);
                }
                $filters = $filters->replace([$indexToReplace => $filter]);
            }
        } else {
            $filters->add($filter);
        }

        return $this->saveFilters($filters);
    }

    public function unsetFilter(Filter $filter): bool
    {
        $success = true;
        $filters = $this->getFilters();
        foreach ($filters as $index => $currentFilter) {
            if ($currentFilter->attributeId === $filter->attributeId) {
                $filters->forget($index);
            }
        }
        // Check whether the filter was removed
        foreach ($filters as $currentFilter) {
            if ($currentFilter->attributeId === $filter->attributeId) {
                $success = false;
                break;
            }
        }

        return $success && $this->saveFilters($filters);
    }

    public function getFilters(): FilterCollection
    {
        if (session('filters') === null) {
            session(['filters' => serialize(new FilterCollection())]);
        }

        return $this->cleanupFilters(unserialize(session('filters')));
    }

    protected function saveFilters(FilterCollection $filters): bool
    {
        session(['filters' => serialize($filters)]);
        // We need to persist the changes to session right now, because if someone uses die() after this, it won't be
        // saved to the session (Laravel actually saves the session at the end of a lifecycle, not immediately)
        session()->save();
        $retrievedFilters = $this->getFilters();

        return $retrievedFilters == $filters;
    }

    protected function cleanupFilters(FilterCollection $filters): FilterCollection
    {
        $existingAttributeIds = [];
        // Remove filters with the same attributeId that are not ranged
        $filters = $filters->reject(function (Filter $filter) use (&$existingAttributeIds) {
            if (
                array_key_exists($filter->attributeId, $existingAttributeIds) &&
                $filter->isRanged() && count($existingAttributeIds[$filter->attributeId]) >= 2
            ) {
                // This attribute already exists in the filters and it is a ranged filter and there are already two.
                // In that case, a third is not allowed, so remove it
                // Pay attention: The next case is different because a ranged filter can have the same value twice
                // but an unranged filter cannot. For example, a length filter with a min of 2 and a max of 2 is fine.
                return true;
            }
            if (array_key_exists($filter->attributeId, $existingAttributeIds) && $filter->isRanged() === false) {
                // This attribute already exists in the filters and it's an unranged filter, remove it
                return true;
            }

            if (!array_key_exists($filter->attributeId, $existingAttributeIds)) {
                $existingAttributeIds[$filter->attributeId] = [];
            }

            $existingAttributeIds[$filter->attributeId][] = $filter->value;

            return false;
        });

        return $filters;
    }

    /**
     * @param ProductCollection|\Insyht\LarvelousShop\Models\Product[] $items
     *
     * @return \Insyht\LarvelousShop\Collections\ProductCollection
     */
    public function applyFilters(ProductCollection|array $items): ProductCollection
    {
        $filters = $this->getFilters();
        if ($filters->isEmpty()) {
            return $items;
        }

        $simplifiedFilters = [];
        foreach ($filters as $filter) {
            /** @var Filter $filter */
            if ($filter->isRanged()) {
                if (!array_key_exists($filter->attributeId, $simplifiedFilters)) {
                    $simplifiedFilters[$filter->attributeId] = [
                        'type' => 'ranged',
                        'attributeId' => $filter->attributeId,
                        'min' => $filter->value,
                        'max' => $filter->value,
                        'current' => $filter->value,
                    ];
                } else {
                    $previousValue = $simplifiedFilters[$filter->attributeId]['current'];
                    if ($filter->value > $previousValue) {
                        $simplifiedFilters[$filter->attributeId]['min'] = $previousValue;
                        $simplifiedFilters[$filter->attributeId]['max'] = $filter->value;
                    } else {
                        $simplifiedFilters[$filter->attributeId]['min'] = $filter->value;
                        $simplifiedFilters[$filter->attributeId]['max'] = $previousValue;
                    }
                    unset($simplifiedFilters[$filter->attributeId]['current']);
                }
            } else {
                $simplifiedFilters[$filter->attributeId] = [
                    'type' => 'unranged',
                    'attributeId' => $filter->attributeId,
                    'value' => $filter->value,
                ];
            }
        }

        return $this->filterProductsByFilterValues($items, $simplifiedFilters);
    }

    protected function filterProductsByFilterValues(
        ProductCollection|array $items,
        array $simplifiedFilters
    ): ProductCollection|array {
        return $items->filter(function (Product $product) use ($simplifiedFilters) {
            $productAttributeIds = $product->attributes()->pluck('id')->toArray();
            foreach ($simplifiedFilters as $filter) {
                $filterAttributeId = $filter['attributeId'];
                $filterType = $filter['type'];
                if (!in_array($filterAttributeId, $productAttributeIds)) {
                    // Product does not have this attribute, so filter this product out
                    return false;
                }
                $attribute = ProductAttribute::find($filterAttributeId);
                if (!$attribute) {
                    // Attribute does not exist (anymore), ignore the filter and keep the product in the collection
                    continue;
                }
                $filterAttributeValue = $product->attributeValue($attribute);
                if ($filterType === 'unranged' && $filterAttributeValue !== $filter['value']) {
                    // Product does have this attribute but the value is not equal to a filter, filter product out
                    return false;
                } elseif (
                    $filterType === 'ranged' &&
                    ($filterAttributeValue < $filter['min'] || $filterAttributeValue > $filter['max'])
                ) {
                    // Product has this attribute but the value is not within the range of a filter, filter product out
                    return false;
                }
            }

            return true;
        });
    }

    public function isFilterableActive(Filterable $filterable): bool
    {
        $filters = $this->getFilters();
        foreach ($filters as $filter) {
            if ($filter->attributeId === $filterable->attribute->id && $filter->value === $filterable->value) {
                return true;
            }
        }

        return false;
    }
}
