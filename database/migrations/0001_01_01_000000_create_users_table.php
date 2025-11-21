<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Login Credentials
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');

            // Profile Fields
            $table->string('profile_picture')->nullable();
            $table->string('name')->nullable();
            $table->string('major')->nullable();
            $table->string('location')->nullable();
            $table->string('field')->nullable();
            $table->string('education')->nullable();
            $table->string('gpa')->nullable();
            $table->string('preferred_country')->nullable();
            $table->longText('about')->nullable();

            // For Laravel
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
