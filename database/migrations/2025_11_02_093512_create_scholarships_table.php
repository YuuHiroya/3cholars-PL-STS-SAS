<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('location')->nullable();
            $table->string('main_img')->nullable();
            $table->date('application_deadline')->nullable();
            $table->integer('amount')->nullable();
            $table->year('established_year')->nullable();
            $table->string('additional_img_1')->nullable();
            $table->string('additional_img_2')->nullable();
            $table->string('additional_img_3')->nullable();
            $table->string('additional_img_4')->nullable();
            $table->text('overview_desc')->nullable();
            $table->text('why_choose_desc')->nullable();
            $table->integer('world_rank')->nullable();
            $table->integer('annual_tuition')->nullable();
            $table->integer('total_students')->nullable();
            $table->float('acceptance_rate')->nullable();
            $table->float('student_faculty_ratio')->nullable();
            $table->text('additional_quick_fact')->nullable();
            $table->string('admissions_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('official_website')->nullable();
            $table->text('eligibility_criteria')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('scholarships');
    }
};
