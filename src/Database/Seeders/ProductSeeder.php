<?php

namespace Insyht\LarvelousShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Insyht\Larvelous\Models\Menu;
use Insyht\Larvelous\Models\MenuItem;
use Insyht\LarvelousShop\Models\Product;
use Insyht\LarvelousShop\Models\ProductAttribute;
use Insyht\LarvelousShop\Models\ProductAttributeGroup;
use Insyht\LarvelousShop\Models\ProductAttributeValue;
use Insyht\LarvelousShop\Models\ProductCategory;
use Insyht\LarvelousShop\Models\ProductImage;
use Insyht\LarvelousShop\Models\ProductOption;
use Insyht\LarvelousShop\Models\ProductParagraph;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $attributeGroup = ProductAttributeGroup::where('title', 'Spenen')->first();
        $attributeGlowDark = ProductAttribute::where('title', 'Glow in the dark')->first();
        $attributeSize = ProductAttribute::where('title', 'Maat')->first();
        $attributeColor = ProductAttribute::where('title', 'Kleur')->first();
        $attributeLength = ProductAttribute::where('title', 'Lengte')->first();
        $attributeBrand = ProductAttribute::where('title', 'Merk')->first();

        $product1 = new Product();
        $product1->title = 'Frigg speen daisy maat 2 Baked clay';
        $product1->price = 5.0;
        $product1->discount_price = 4.5;
        $product1->introduction_title = 'Lorem ipsum dolor sit amet';
        $product1->introduction_text = 'Consectetur adipiscing elit. Proin ut magna et nibh dictum dignissim. Curabitur imperdiet tellus ac dolor dictum consequat. Morbi placerat mauris ac eros tincidunt, ut tristique sem ornare. Cras vitae libero dolor. Vestibulum blandit dapibus mi, in aliquam metus. Nulla tristique fermentum massa a interdum. Nullam lectus quam, hendrerit sollicitudin aliquet vitae, luctus sollicitudin massa. Nullam et volutpat lacus. Nam faucibus lorem mauris, vitae ornare ligula maximus facilisis.';
        $product1->url = 'product';
        $product1->main_image = 'storage/images/placeholder.jpg';
        $product1->save();
        $product1->refresh();
        $product1->productAttributeGroup()->associate($attributeGroup);

        $value = new ProductAttributeValue();
        $value->product_id = $product1->id;
        $value->product_attribute_id = $attributeGlowDark->id;
        $value->value = 'Ja';
        $value->save();
        $value = new ProductAttributeValue();
        $value->product_id = $product1->id;
        $value->product_attribute_id = $attributeSize->id;
        $value->value = '2';
        $value->save();
        $value = new ProductAttributeValue();
        $value->product_id = $product1->id;
        $value->product_attribute_id = $attributeColor->id;
        $value->value = 'Rood';
        $value->save();
        $value = new ProductAttributeValue();
        $value->product_id = $product1->id;
        $value->product_attribute_id = $attributeLength->id;
        $value->value = '10 cm';
        $value->save();
        $value = new ProductAttributeValue();
        $value->product_id = $product1->id;
        $value->product_attribute_id = $attributeBrand->id;
        $value->value = 'Frigg';
        $value->save();

        $product1->categories()->attach(ProductCategory::where('title', 'Categorie')->first(), ['order' => 1]);
        $product1->save();
        $product1->refresh();
        $this->addParagraphs($product1);
        $product1->options()->attach(
            [
                ProductOption::where('title', 'Hoeveel kleuren kralen?')->first()->id => ['order' => 1],
                ProductOption::where('title', 'Kleur kraal')->first()->id => ['order' => 2],
                ProductOption::where('title', 'Luxe slotje')->first()->id => ['order' => 3],
                ProductOption::where('title', 'Naam')->first()->id => ['order' => 4],
            ]
        );

        $image = new ProductImage();
        $image->image = 'storage/images/placeholder.jpg';
        $image->order = 0;
        $image->product()->associate($product1);
        $image->save();
        $image = new ProductImage();
        $image->image = 'storage/images/placeholder.jpg';
        $image->order = 1;
        $image->product()->associate($product1);
        $image->save();

        $item = new MenuItem();
        $item->item_id = $product1->id;
        $item->item_type = Product::class;
        $item->ordering = 6;
        Menu::where('position', 'main_menu')->first()->items()->save($item);

        $product = new Product();
        $product->title = 'Productnaam';
        $product->price = 9.5;
        $product->discount_price = 6.5;
        $product->introduction_title = 'Lorem ipsum dolor sit amet';
        $product->introduction_text = 'Consectetur adipiscing elit. Proin ut magna et nibh dictum dignissim. Curabitur imperdiet tellus ac dolor dictum consequat. Morbi placerat mauris ac eros tincidunt, ut tristique sem ornare. Cras vitae libero dolor. Vestibulum blandit dapibus mi, in aliquam metus. Nulla tristique fermentum massa a interdum. Nullam lectus quam, hendrerit sollicitudin aliquet vitae, luctus sollicitudin massa. Nullam et volutpat lacus. Nam faucibus lorem mauris, vitae ornare ligula maximus facilisis.';
        $product->url = 'product2';
        $product->main_image = 'storage/images/placeholder.jpg';
        $product->save();
        $product->refresh();
        $product->productAttributeGroup()->associate($attributeGroup);

        $product1->related()->attach($product->id);

        $value = new ProductAttributeValue();
        $value->product_id = $product->id;
        $value->product_attribute_id = $attributeGlowDark->id;
        $value->value = 'Nee';
        $value->save();
        $value = new ProductAttributeValue();
        $value->product_id = $product->id;
        $value->product_attribute_id = $attributeSize->id;
        $value->value = '3';
        $value->save();
        $value = new ProductAttributeValue();
        $value->product_id = $product->id;
        $value->product_attribute_id = $attributeColor->id;
        $value->value = 'Groen';
        $value->save();
        $value = new ProductAttributeValue();
        $value->product_id = $product->id;
        $value->product_attribute_id = $attributeLength->id;
        $value->value = '80 cm';
        $value->save();
        $value = new ProductAttributeValue();
        $value->product_id = $product->id;
        $value->product_attribute_id = $attributeBrand->id;
        $value->value = 'Bibs';
        $value->save();

        $product->categories()->attach(ProductCategory::where('title', 'Subcategorie')->first(), ['order' => 1]);
        $product->save();
        $product->refresh();
    }

    protected function addParagraphs(Product $product): void
    {
        $paragraph = new ProductParagraph();
        $paragraph->title = 'Lorem ipsum dolor sit amet';
        $paragraph->text = 'Consectetur adipiscing elit. Proin ut magna et nibh dictum dignissim. Curabitur imperdiet tellus ac dolor dictum consequat. Morbi placerat mauris ac eros tincidunt, ut tristique sem ornare. Cras vitae libero dolor. Vestibulum blandit dapibus mi, in aliquam metus. Nulla tristique fermentum massa a interdum. Nullam lectus quam, hendrerit sollicitudin aliquet vitae, luctus sollicitudin massa. Nullam et volutpat lacus. Nam faucibus lorem mauris, vitae ornare ligula maximus facilisis.';
        $paragraph->url = '';
        $paragraph->product()->associate($product);
        $paragraph->save();

        $paragraph = new ProductParagraph();
        $paragraph->title = 'Lorem ipsum dolor sit amet';
        $paragraph->text = 'Consectetur adipiscing elit. Proin ut magna et nibh dictum dignissim. Curabitur imperdiet tellus ac dolor dictum consequat. Morbi placerat mauris ac eros tincidunt, ut tristique sem ornare. Cras vitae libero dolor. Vestibulum blandit dapibus mi, in aliquam metus. Nulla tristique fermentum massa a interdum. Nullam lectus quam, hendrerit sollicitudin aliquet vitae, luctus sollicitudin massa. Nullam et volutpat lacus. Nam faucibus lorem mauris, vitae ornare ligula maximus facilisis.';
        $paragraph->image = 'storage/images/placeholder.jpg';
        $paragraph->url = '/product/product';
        $paragraph->url_text = 'Lees meer';
        $paragraph->image_position = 'left';
        $paragraph->product()->associate($product);
        $paragraph->save();

        $paragraph = new ProductParagraph();
        $paragraph->title = 'Lorem ipsum dolor sit amet';
        $paragraph->text = 'Consectetur adipiscing elit. Proin ut magna et nibh dictum dignissim. Curabitur imperdiet tellus ac dolor dictum consequat. Morbi placerat mauris ac eros tincidunt, ut tristique sem ornare. Cras vitae libero dolor. Vestibulum blandit dapibus mi, in aliquam metus. Nulla tristique fermentum massa a interdum. Nullam lectus quam, hendrerit sollicitudin aliquet vitae, luctus sollicitudin massa. Nullam et volutpat lacus. Nam faucibus lorem mauris, vitae ornare ligula maximus facilisis.';
        $paragraph->url = '';
        $paragraph->product()->associate($product);
        $paragraph->save();
    }
}
