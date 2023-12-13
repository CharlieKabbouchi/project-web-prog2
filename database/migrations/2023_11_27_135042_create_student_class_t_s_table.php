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
        Schema::create('student_class_t_s', function (Blueprint $table) {
            $table->string('student_id');
            $table->unsignedBigInteger('classt_id');
            $table->foreign('student_id')
            ->references('id')
            ->on('students')
            ->onDelete('cascade');
            $table->foreign('classt_id')
            ->references('id')
            ->on('class_t_s')
            ->onDelete('cascade');
            $table->timestamps();
            $table->integer('attendence')->default(0);
            $table->float('averageGrade')->nullable();
            $table->float('quizGrade')->nullable();
            $table->float('projectGrade')->nullable();
            $table->float('assignmentGrade')->nullable();
            $table->primary(['student_id', 'classt_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_class_t_s');
    }
};
