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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('oid', 24)->nullable();                      // Unique order ID
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('company')->nullable();
            $table->string('company_address')->nullable();
            $table->string('pib')->nullable();
            $table->text('note')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('total')->nullable();
            $table->string('status', 32)->nullable();
            $table->boolean('invoice_sent')->default(0);
            $table->string('shipping_service')->nullable();
            $table->string('shipping_number')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->softDeletes();
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
