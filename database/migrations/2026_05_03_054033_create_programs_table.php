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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('program_name')->nullable();
            $table->decimal('fees', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->enum('degree_type', ['Bachelor', 'Master', 'PhD', 'Diploma', 'Certificate']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('program_code')->unique();
            $table->integer('duration_years'); 
            $table->integer('duration_semesters');
            $table->text('entry_requirements')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
