<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->text('url');
            $table->text('image')->nullable();
            $table->unsignedBigInteger('parent_category')->nullable();
            $table->integer('order');

            $table->index('parent_category');
            $table->foreign('parent_category')
                  ->references('id')
                  ->on('product_category')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category');
    }
};
