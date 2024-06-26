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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->Time('staringTime');
            $table->Time('endTime');
            $table->DateTime('date')->nullable();
            $table->longText('description')->nullable();
            $table->string('dayOfTheWeek')->nullable();
            $table->integer('year')->nullable();
            $table->string('month')->nullable();
            $table->unsignedBigInteger('classt_id')->nullable();
            $table->string('student_id')->nullable(); 
            $table->string('teacher_id')->nullable(); 
            $table->foreign('teacher_id')
            ->references('id')
            ->on('teachers')
            ->onDelete('cascade');
            $table->foreign('student_id')
            ->references('id')
            ->on('students')
            ->onDelete('cascade');
            $table->foreign('classt_id')
            ->references('id')
            ->on('class_t_s')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
