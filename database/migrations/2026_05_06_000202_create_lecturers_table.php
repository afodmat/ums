<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('lecturer_number')->unique();
            $table->string('specialization')->nullable();
            $table->json('qualification')->nullable();
            $table->integer('years_of_experience')->default(0);
            $table->date('join_date')->nullable();
            $table->enum('employment_type', ['full_time', 'part_time', 'contract'])->default('full_time');
            $table->string('office_location')->nullable();
            $table->string('office_phone')->nullable();
            $table->json('consultation_hours')->nullable();
            $table->text('research_interests')->nullable();
            $table->text('publications')->nullable();
            $table->string('photo')->nullable();
            $table->text('biography')->nullable();
            $table->enum('status', ['active', 'on_leave', 'terminated'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('course_lecturer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_unit_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('lecturer_id')->constrained()->onDelete('cascade');
            $table->string('semester')->nullable();
            $table->string('academic_year')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};