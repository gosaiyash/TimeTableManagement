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
        Schema::create('set_sub_fac_stu', function (Blueprint $table) {
            $table->id();
            $table->integer("faculty_id")->references('f_id')->on('add_faculty_models');
            $table->integer("subject_id")->references('id')->on('subject_models');
            $table->integer("min_lec");
            $table->integer("max_lec");
            $table->integer("daily_lec");
            $table->integer("total_lec");
            $table->integer("remain_A");
            $table->integer("remain_B");
            $table->integer("remain_C");
            $table->integer("remain_D");
            $table->String("roomno");
            $table->String("class_type");
            $table->integer("deleted")->default(0);
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
