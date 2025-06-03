<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    public function up()
    {
         Schema::create('gurus', function (Blueprint $table) {
    $table->id('id_guru');
    $table->string('username')->unique();
    $table->string('password');
    $table->rememberToken(); // Tambahkan ini
    $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gurus');
    }
}
