<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExpiredStatus extends Migration
{
    public function up()
    {
        Schema::create('expired_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('expired_status', 250)->nullable()->default('');
            $table->integer('total')->default(0);
            $table->string('color_code', 250)->nullable()->default('');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expired_status');
    }
}
