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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('slug');
            $table->text('price_id')->nullable();
            $table->string('url')->nullable();
            $table->text('short')->nullable();
            $table->text('declaration')->nullable();
            $table->longText('description')->nullable();
            $table->float('selling_price')->nullable();
            $table->float('purchase_price')->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('company')->nullable();
            $table->timestamp('last_price_at')->nullable();
            $table->string('status')->default('published')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
