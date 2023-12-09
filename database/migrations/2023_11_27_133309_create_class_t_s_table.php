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
        Schema::create('class_t_s', function (Blueprint $table) {
            $table->id();
            $table->Date('startingDate');
            $table->Date('endingDate');
            $table->time('starttime');
            $table->time('endtime');
            $table->string('DayofWeek');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('semester_id');
            $table->string('teacher_id')->nullable();
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
            $table->foreign('teacher_id')
            ->references('id')
            ->on('teachers')
            ->onDelete('cascade');
            $table->foreign('course_id')
            ->references('id')
            ->on('courses')
            ->onDelete('cascade');
            $table->integer('abscence');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_t_s');
    }
};
