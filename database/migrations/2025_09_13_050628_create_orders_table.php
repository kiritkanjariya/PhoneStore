<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('order_number')->unique();
            $table->decimal('total_amount', 10, 2);

            $table->enum('order_status', ['pending','delivered'])->default('pending');

            $table->json('items');

            $table->string('shipping_name');
            $table->string('shipping_address');
            $table->string('shipping_phone');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
