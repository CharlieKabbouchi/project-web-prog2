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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('fileType')->nullable();
            $table->longText('attachmentlink', 1000)->nullable();
            $table->integer('grade')->nullable();
            $table->DateTime('timeOfSubmission');
            $table->unsignedBigInteger('assignment_id');
            $table->string('student_id');
            $table->foreign('student_id')
            ->references('id')
            ->on('students')
            ->onDelete('cascade');
            $table->foreign('assignment_id')
            ->references('id')
            ->on('assignments')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
