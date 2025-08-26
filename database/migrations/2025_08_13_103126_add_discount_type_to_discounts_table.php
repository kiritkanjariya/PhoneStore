<?php

use App\Models\Products;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // In the new migration file

    public function up(): void
    {
        Schema::table('discounts', function (Blueprint $table) {
            // Change the column to allow NULL values
            $table->enum('discount_type', ['percentage', 'fixed'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discounts', function (Blueprint $table) {
            //
        });
    }
};
