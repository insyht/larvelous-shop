<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Insyht\Larvelous\Models\MenuItemType;
use Insyht\LarvelousShop\Models\Product;
use Insyht\LarvelousShop\Models\ProductCategory;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->unsignedDecimal('price', 8, 2);
            $table->unsignedDecimal('discount_price', 8, 2)->nullable();
            $table->string('introduction_title', 200)->nullable();
            $table->text('introduction_text')->nullable();
            $table->text('url');
            $table->text('main_image')->nullable();
            $table->unsignedBigInteger('product_attribute_group_id')->nullable();

            $table->index('product_attribute_group_id');
            $table->foreign('product_attribute_group_id')
                  ->references('id')
                  ->on('product_attribute_groups')
                  ->onUpdate('set null')
                  ->onDelete('set null');
        });

        Schema::create('product_product_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('order');

            $table->index('product_category_id');
            $table->foreign('product_category_id')
                  ->references('id')
                  ->on('product_categories')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->index('product_id');
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->bigInteger('product_id', false, true);
            $table->bigInteger('product_attribute_id', false, true);
            $table->text('value');

            $table->primary(['product_id', 'product_attribute_id']);
            $table->index('product_id');
            $table->index('product_attribute_id');

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onUpdate('cascade')->onDelete('cascade');
        });

        $type = new MenuItemType();
        $type->classname = Product::class;
        $type->title_column = 'title';
        $type->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        MenuItemType::where('classname', Product::class)->delete();
        Schema::dropIfExists('product_product_category');
        Schema::dropIfExists('products');
    }
};
