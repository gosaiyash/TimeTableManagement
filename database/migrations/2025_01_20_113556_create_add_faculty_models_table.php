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
        Schema::create('add_faculty_models', function (Blueprint $table) {
            $table->id('f_id');
            $table->string('faculty_code');
            $table->string('faculty_name');
            $table->string('faculty_mo');
            $table->string('email');
            $table->string('deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_faculty_models');
    }
};
