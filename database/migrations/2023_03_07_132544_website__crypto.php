<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
        Schema::create('crypto', function (Blueprint $table){
            $table->id();
            $table->date('tanggal');
            $table->integer('high');
            $table->integer('low');
            $table->integer('volume');
        });
    }
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('crypto');
    }
}
