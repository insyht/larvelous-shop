<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Insyht\LarvelousShop\Models\ProductOption;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('language_id', false, true);
            $table->text('title');
            $table->enum(
                'type',
                [
                    ProductOption::TYPE_RADIO,
                    ProductOption::TYPE_BOOL,
                    ProductOption::TYPE_TEXT,
                    ProductOption::TYPE_RELATED,
                ]
            );
            $table->unsignedBigInteger('related_option_id')->nullable();

            $table->index('language_id');
            $table->foreign('language_id')
                  ->references('id')
                  ->on('languages')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->index('related_option_id');
            $table->foreign('related_option_id')
                  ->references('id')
                  ->on('product_options')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

        Schema::create('product_product_option', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_option_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('order');

            $table->index('product_option_id');
            $table->foreign('product_option_id')
                  ->references('id')
                  ->on('product_options')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->index('product_id');
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

        Schema::create('product_option_choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_option_id');
            $table->text('title');
            $table->unsignedInteger('order');

            $table->index('product_option_id');
            $table->foreign('product_option_id')
                  ->references('id')
                  ->on('product_options')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_product_option');
        Schema::dropIfExists('product_options');
    }
};
