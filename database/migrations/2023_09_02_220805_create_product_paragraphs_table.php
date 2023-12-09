<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_paragraphs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('title')->nullable()->default(null);
            $table->text('text')->nullable();
            $table->text('image')->nullable();
            $table->text('url')->nullable();
            $table->string('url_text')->nullable()->default(null);
            $table->enum('image_position', ['left', 'right'])->nullable()->default(null);

            $table->index('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_paragraphs');
    }
};
