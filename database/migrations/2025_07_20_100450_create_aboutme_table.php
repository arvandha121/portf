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
    public function up()
    {
        Schema::create('about_me', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->text('description');
            $table->integer('years_experience')->default(0);
            $table->integer('certification_total')->default(0);
            $table->integer('companies_worked')->default(0);
            $table->string('cv_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aboutme');
    }
};
