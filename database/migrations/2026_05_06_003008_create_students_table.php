<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('student_number')->unique();
            $table->foreignId('program_id')->nullable()->constrained()->nullOnDelete();
            $table->date('enrollment_date')->nullable();
            $table->date('expected_graduation_date')->nullable();
            $table->integer('current_semester')->default(1);
            $table->enum('academic_status', ['active', 'suspended', 'graduated', 'withdrawn'])->default('active');
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('parent_email')->nullable();
            $table->text('address')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('high_school_name')->nullable();
            $table->decimal('high_school_gpa', 3, 2)->nullable();
            $table->string('previous_institution')->nullable();
            $table->integer('transfer_credits')->default(0);
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};