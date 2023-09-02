<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->unsignedBigInteger('shipping_method_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('shipment_id')->nullable();
            $table->text('remarks')->nullable()->default(null);
            $table->timestamps();

            $table->index('session_id');
            $table->index('payment_method_id');
            $table->index('shipping_method_id');
            $table->index('payment_id');
            $table->index('customer_id');
            $table->index('shipment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
