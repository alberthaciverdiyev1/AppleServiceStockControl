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
        // Creating 'brands' table
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        // Creating 'sellers' table (Fixed syntax)
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // Creating 'product_models' table
        Schema::create('product_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        // Creating 'parts' table
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('model_id')->constrained('product_models')->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        // Creating 'products' table (Fixed foreign key constraint)
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')->constrained('product_models')->cascadeOnDelete();
            $table->foreignId('part_id')->constrained('parts')->cascadeOnDelete()->default(0);
            $table->string('name');
            $table->string('code');
            $table->integer('quantity')->default(0);
            $table->float('buying_price');
            $table->float('selling_price');
            $table->softDeletes();
            $table->timestamps();
        });

        // Modifying 'products' table
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('code')->nullable()->change();
        });

        // Creating 'sales' table
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->string('name')->nullable();
            $table->integer('quantity')->default(0);
            $table->enum('pay_type',['cash','debt'])->default('cash');
            $table->double('price')->default(0);
            $table->string('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // Creating 'purchases' table
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->enum('pay_type',['cash','debt'])->default('cash');
            $table->double('price')->default(0);
            $table->string('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('products');
        Schema::dropIfExists('parts');
        Schema::dropIfExists('product_models');
        Schema::dropIfExists('sellers');
        Schema::dropIfExists('brands');
    }
};
