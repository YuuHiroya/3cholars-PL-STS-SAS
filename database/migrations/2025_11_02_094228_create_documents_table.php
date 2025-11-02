<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->string('official_transcript')->nullable();
            $table->string('passport')->nullable();
            $table->string('letter_recommendation_1')->nullable();
            $table->string('letter_recommendation_2')->nullable();
            $table->string('portfolio')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('documents');
    }
};
