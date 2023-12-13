<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Insyht\Larvelous\Models\MenuItemType;
use Insyht\Larvelous\Models\Page;
use Insyht\LarvelousShop\Models\ProductCategory;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->text('introduction');
            $table->text('url');
            $table->text('image')->nullable();
            $table->unsignedBigInteger('parent_category')->nullable();
            $table->unsignedInteger('order');

            $table->index('parent_category');
            $table->foreign('parent_category')
                  ->references('id')
                  ->on('product_categories')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

        $type = new MenuItemType();
        $type->classname = ProductCategory::class;
        $type->title_column = 'title';
        $type->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        MenuItemType::where('classname', ProductCategory::class)->delete();
        Schema::dropIfExists('product_categories');
    }
};
