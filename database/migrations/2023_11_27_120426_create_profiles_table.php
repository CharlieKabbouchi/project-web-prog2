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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->Date('dateOfBirth');
            $table->string('alumni_id')->nullable();
            $table->string('teacher_id')->nullable();
            $table->string('student_id')->nullable();
            $table->string('sparent_id')->nullable();
            $table->string('admin_id')->nullable();
            $table->foreign('alumni_id')
            ->nullable()
            ->references('id')
            ->on('alumnis')
            ->onDelete('cascade');
            $table->foreign('teacher_id')
            ->nullable()
            ->references('id')
            ->on('teachers')
            ->onDelete('cascade');
            $table->foreign('student_id')
            ->nullable()
            ->references('id')
            ->on('students')
            ->onDelete('cascade');
            $table->foreign('sparent_id')
            ->nullable()
            ->references('id')
            ->on('s_parents')
            ->onDelete('cascade');
            $table->foreign('admin_id')
            ->nullable()
            ->references('id')
            ->on('admins')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
