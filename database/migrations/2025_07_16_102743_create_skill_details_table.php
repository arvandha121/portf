<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('skill_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_id');
            $table->string('subtitle'); // contoh: HTML, CSS
            $table->string('experience')->default(''); // < 1 tahun, dst
            $table->integer('percentage'); // 0-100%
            $table->timestamps();

            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_details');
    }
};
