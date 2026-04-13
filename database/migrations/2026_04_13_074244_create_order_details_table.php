<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('Quantity');
            $table->decimal('Unit_Price', 10, 2);
            $table->text('Notes')->nullable();
            $table->foreignId('Orders_ID')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('Menu_Items_ID')->constrained('menu_items')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};