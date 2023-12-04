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
        Schema::create('upload_resources', function (Blueprint $table) {
            $table->id();
            $table->string('attachement');
            $table->unsignedBigInteger('classt_id');
            $table->string('teacher_id');
            $table->foreign('teacher_id')
            ->references('id')
            ->on('teachers')
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
        Schema::dropIfExists('upload_resources');
    }
};
