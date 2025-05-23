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
            $table->string('name')->nullable(false);
            $table->decimal('price', 8, 2)->nullable(false);
            $table->integer('net_content')->nullable(false);
            $table->integer('stockInGrams')->nullable(false);
            $table->date('updated_at');
            $table->date('created_at');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
           
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
