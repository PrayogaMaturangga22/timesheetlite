<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserCheckIn extends Migration
{
    public function up()
    {
        Schema::create('user_checkin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('checkin_status', 250)->nullable()->default('');
            $table->integer('total')->default(0);
            $table->string('color_code', 250)->nullable()->default('');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_checkin');
    }
}
