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
        Schema::create('review_e_s', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->float('rating');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('student_id')->nullable();
            $table->foreign('student_id')
            ->references('id')
            ->on('students')
            ->onDelete('cascade');
            $table->foreign('event_id')
            ->references('id')
            ->on('events')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_e_s');
    }
};
