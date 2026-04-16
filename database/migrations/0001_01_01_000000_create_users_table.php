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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // في المخطط اسمها Full_Name بس name ممتازة وما بتأثر
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // --- الإضافات بناءً على المخطط تبعك ---
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('status', 20)->default('active'); 
            $table->enum('role', ['employee', 'customer']);
            
            // --- حقول الـ Morphs (العلاقة) ---
            // دالة nullableMorphs بتنشئ لحالها عمودين: actor_id و actor_type
            // استخدمنا nullable عشان لو حبيتي تعملي يوزر (زي الـ Admin) ما يكون تابع لموظف أو زبون
            $table->nullableMorphs('actor'); 

            $table->rememberToken();
            $table->timestamps();
        });

        // الجداول الافتراضية التانية بنسيبها زي ما هي
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};