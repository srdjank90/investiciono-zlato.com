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
            $table->string('unique_key');
            $table->string('name');
            $table->string('name_default')->nullable();
            $table->text('slug');
            $table->text('slug_default')->nullable();
            $table->string('producer')->nullable();
            $table->string('producer_short')->nullable();
            $table->string('quantity_type')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('price_id')->nullable();
            $table->string('url')->nullable();
            $table->string('purchase_price_url')->nullable();
            $table->text('short')->nullable();
            $table->text('declaration')->nullable();
            $table->longText('description')->nullable();
            $table->float('selling_price')->nullable();
            $table->float('purchase_price')->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('company_name')->nullable();
            $table->timestamp('last_price_at')->nullable();
            $table->string('status')->default('published')->nullable();
            $table->string('status')->default('published')->nullable();
            $table->string('product_image_url')->nullable();
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
