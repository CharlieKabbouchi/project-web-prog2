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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('graduationCertificateImage');
            $table->longText('description');
            $table->string('alumuni_id')->nullable();
            $table->string('teacher_id')->nullable();
            $table->foreign('alumuni_id')
            ->nullable()
            ->references('id')
            ->on('alumunis')
            ->onDelete('cascade');
            $table->foreign('teacher_id')
            ->nullable()
            ->references('id')
            ->on('teachers')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
