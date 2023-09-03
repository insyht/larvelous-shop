<?php

namespace Insyht\LarvelousShop\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Insyht\LarvelousShop\Helpers\FilterHelper;
use Insyht\LarvelousShop\Models\ProductAttribute;
use Insyht\LarvelousShop\Models\ProductAttributeGroup;
use Insyht\LarvelousShop\Models\ProductAttributeType;
use Insyht\LarvelousShop\Tests\TestCase;

class AddCategoryFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function add_a_category_filter()
    {
        $this->withoutExceptionHandling();

        $filterName = 'filterName';
        $filterValue = 'filterValue';

        $attribute = $this->createAttribute($filterName);

        $this->post('filter', [$filterName => $filterValue]);
        /** @var \Insyht\LarvelousShop\Collections\FilterCollection $filters */
        $filters = app(FilterHelper::class)->getFilters();

        $this->assertNotNull($filters->first());
        $this->assertEquals($filters->first()->attributeId, $attribute->id);
        $this->assertEquals($filters->first()->value, $filterValue);
    }

    protected function createAttribute(string $filterName): ProductAttribute
    {
        $attributeGroup = new ProductAttributeGroup();
        $attributeGroup->language_id = 1;
        $attributeGroup->title = 'filterGroupName';
        $attributeGroup->order = 1;
        $attributeGroup->save();
        $attributeGroup->refresh();

        $attributeType = new ProductAttributeType();
        $attributeType->language_id = 1;
        $attributeType->title = 'x';
        $attributeType->template = 'text';
        $attributeType->is_ranged = false;
        $attributeType->save();
        $attributeType->refresh();

        $attribute = new ProductAttribute();
        $attribute->title = $filterName;
        $attribute->language_id = 1;
        $attribute->product_attribute_group_id = $attributeGroup->id;
        $attribute->product_attribute_type_id = $attributeType->id;
        $attribute->order = 1;
        $attribute->save();

        return $attribute;
    }

}
