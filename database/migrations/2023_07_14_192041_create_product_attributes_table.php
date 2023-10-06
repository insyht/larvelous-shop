<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('language_id', false, true);
            $table->string('title', 200);
            $table->integer('order', false, true);

            $table->index('language_id');
            $table->index('order');
            $table->unique(['language_id', 'title']);

            $table->foreign('language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('product_attribute_types', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('language_id', false, true);
            $table->string('title', 50);
            $table->text('template');
            $table->boolean('is_ranged')->default(false)->unsigned();

            $table->index('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('language_id', false, true);
            $table->string('title', 200);
            $table->bigInteger('product_attribute_group_id', false, true);
            $table->bigInteger('product_attribute_type_id', false, true);
            $table->text('unit')->default('');
            $table->integer('order', false, true);

            $table->index('product_attribute_group_id');
            $table->index('product_attribute_type_id');
            $table->index('language_id');
            $table->index('order');
            $table->unique(['title', 'language_id', 'product_attribute_group_id'], 'unique_t_l_pagi');

            $table->foreign('language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_attribute_group_id')
                  ->references('id')
                  ->on('product_attribute_groups')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreign('product_attribute_type_id')
                  ->references('id')
                  ->on('product_attribute_types')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute_groups');
        Schema::dropIfExists('product_product_attribute');
        Schema::dropIfExists('product_attributes');
    }
};
