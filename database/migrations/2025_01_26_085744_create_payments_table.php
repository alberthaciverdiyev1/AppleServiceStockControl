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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('sale_id')->nullable();
            $table->string('purchase_id')->nullable();
            $table->double('amount')->default(0);
            $table->enum('type', ['cash', 'debt'])->default('cash');
            $table->enum('sale_or_purchase', ['sale', 'purchase'])->default('sale');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
