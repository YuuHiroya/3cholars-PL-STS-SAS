<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('formeducation_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->string('current_school');
            $table->string('academic_level')->nullable();
            $table->date('expected_graduation_date')->nullable();
            $table->float('current_gpa')->nullable();
            $table->string('major')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('form_education_informations');
    }
};
