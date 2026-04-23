<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('job_title'); 
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};