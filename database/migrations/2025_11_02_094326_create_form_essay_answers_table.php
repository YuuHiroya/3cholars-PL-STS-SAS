<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('form_essay_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->text('personal_statement')->nullable();
            $table->text('why_deserve_scholarship')->nullable();
            $table->text('future_goals')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('form_essay_answers');
    }
};
