<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserSex extends Migration
{
    public function up()
    {
        Schema::create('user_sex', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sex', 250)->nullable()->default('');
            $table->integer('total')->default(0);
            $table->string('color_code', 250)->nullable()->default('');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_sex');
    }
}
