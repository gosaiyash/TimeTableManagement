<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\singup_model;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_singup_models', function (Blueprint $table) {
            $table->id();
            $table->string("enrollment_no");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("sem");
            $table->string("email");
            $table->string("password");
            $table->string("birthdate");
            $table->string("deleted");
            $table->string("img");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
