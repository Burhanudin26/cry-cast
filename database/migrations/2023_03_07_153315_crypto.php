<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Crypto extends Migration
{
    public function up()
    {

        Schema::create('crypto', function (Blueprint $table){
            $table->id();
            $table->float('high', 20, 10);
            $table->float('low' , 20, 10);
            $table->float('volume', 30, 10);
        });
        Schema::create('naive_bayes', function (Blueprint $table){
            $table->float('avg_high',20,10);
            $table->float('avg_low',20,10);
            $table->float('avg_volume',20,10);
        });
    }
    public function down()
    {
        Schema::dropIfExists('crypto');
    }
}
