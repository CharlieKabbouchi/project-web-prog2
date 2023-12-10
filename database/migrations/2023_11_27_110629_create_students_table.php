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
        Schema::create('students', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('Gender');
            $table->boolean('isGraduated')->default(false);
            $table->Integer('totalCreditsTaken')->default(0);
            $table->unsignedBigInteger('department_id');
            $table->string('s_parent_id');
            $table->foreign('department_id')
            ->references('id')
            ->on('departments')
            ->onDelete('cascade');
            $table->foreign('s_parent_id')
            ->references('id')
            ->on('s_parents')
            ->onDelete('cascade');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
