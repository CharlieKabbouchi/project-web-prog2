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
        Schema::create('student_events', function (Blueprint $table) {
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
            $table->primary(['student_id', 'event_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_events');
    }
};
