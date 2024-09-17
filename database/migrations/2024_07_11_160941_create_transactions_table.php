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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->unsignedBigInteger('customer_id')->index();
            $table->string('customer_phone', 50);
            $table->string('customer_name');
            $table->string('customer_email', 100)->nullable();

            $table->decimal('subtotal', 17, 2);
            $table->decimal('discount', 17, 2)->nullable();
            $table->decimal('grand_total', 17, 2);

            $table->string('status', 20)->default('outstanding');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
