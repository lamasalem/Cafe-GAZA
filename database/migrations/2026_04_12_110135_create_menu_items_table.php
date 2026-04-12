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
         Schema::create('menu_items', function (Blueprint $table) {
        $table->id();
        $table->string('Item_Name', 100);
        $table->text('Description')->nullable();
        $table->decimal('Price', 10, 2);
        $table->string('Status', 20)->default('available');
        $table->string('Spicy_Level', 45)->nullable();
        $table->foreignId('Menu_Categories_ID')->constrained('menu_categories')->cascadeOnDelete();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
