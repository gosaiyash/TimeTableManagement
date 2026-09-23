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
        Schema::create('temptimetable', function (Blueprint $table) {
            $table->id();
            $table->integer("fs_id")->references('id')->on('set_sub_fac_stu');
            $table->integer("no");
            $table->String("time");
            $table->String("end_time");
            $table->String("division");
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
