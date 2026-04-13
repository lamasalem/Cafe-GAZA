<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internet_sessions', function (Blueprint $table) {
            $table->id();
            $table->datetime('Start_Time');
            $table->datetime('End_Time')->nullable();
            $table->string('Access_Code', 50);
            $table->string('Status', 20)->default('active');
            $table->foreignId('Orders_ID')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('Internet_Services_ID')->constrained('internet_services')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internet_sessions');
    }
};