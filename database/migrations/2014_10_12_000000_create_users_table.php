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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->enum('role', ['admin', 'client', 'provider'])->default('client');
            $table->string('profile_picture')->nullable();
            $table->enum('status', ['pending', 'approved', 'blocked'])->default('pending');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('description')->nullable();
            $table->json('portfolio_images')->nullable();
            $table->foreignId('service_category_id')->nullable()->constrained('service_categories')->onDelete('set null');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
