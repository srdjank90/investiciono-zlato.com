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
            $table->longText('description')->nullable();
            $table->string('subtitle')->nullable();
            $table->float('price')->nullable();
            $table->float('price_old')->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('featured')->nullable();
            $table->boolean('highlighted')->default(0);
            $table->boolean('special')->default(0);
            $table->longText('landing')->nullable();
            $table->string('landing_image')->nullable();
            $table->integer('limit')->nullable();
            $table->string('package')->nullable();
            $table->enum('status', ['draft', 'published', 'auto-draft', 'trashed', 'future']);
            $table->string('sku')->nullable();
            $table->string('ean')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('limit_qunantity')->nullable();
            $table->string('external_id')->nullable();
            $table->string('external_service')->nullable();
            $table->foreignId('created_by')->constrained('users', 'id');
            $table->timestamp('expiry_date')->nullable();
            $table->timestamp('published_at')->nullable();
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
