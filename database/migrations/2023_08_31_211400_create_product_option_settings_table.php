<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_option_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('product_option_product_option_setting', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_option_id');
            $table->unsignedBigInteger('product_option_setting_id');
            $table->text('value');

            $table->index('product_option_id');
            $table->foreign('product_option_id')
                  ->references('id')
                  ->on('product_options')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->index('product_option_setting_id', 'popos_posi_index');
            $table->foreign('product_option_setting_id', 'popos_posi_index')
                  ->references('id')
                  ->on('product_option_settings')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_option_product_option_setting');
        Schema::dropIfExists('product_option_settings');
    }
};
