<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSosmedsTable extends Migration
{
    public function up()
    {
        Schema::create('sosmeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // relasi ke user
            $table->string('platform'); // instagram, github, dll
            $table->string('username')->nullable();
            $table->string('url'); // URL ke profil
            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sosmeds');
    }
}
