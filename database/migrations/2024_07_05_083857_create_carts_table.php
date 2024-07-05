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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            $table->string('user_id', 20)->index();

            $table->string('product_model_id', 20)->index();
            $table->string('product_model_name', 100);

            $table->string('product_unit_id', 20)->index();
            $table->string('product_unit_name', 100);

            $table->unsignedInteger('quantity')->default(1);

            $table->decimal('price', 19, 4);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
