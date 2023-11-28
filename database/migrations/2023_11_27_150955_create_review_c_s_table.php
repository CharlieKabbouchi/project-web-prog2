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
        Schema::create('review_c_s', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->float('rating');
            $table->unsignedBigInteger('classt_id')->nullable();
            $table->string('student_id')->nullable();
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
        Schema::dropIfExists('review_c_s');
    }
};
