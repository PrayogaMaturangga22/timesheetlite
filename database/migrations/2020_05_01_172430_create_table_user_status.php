<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserStatus extends Migration
{
    public function up()
    {
        Schema::create('user_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_status', 250)->nullable()->default('');
            $table->integer('total')->default(0);
            $table->string('color_code', 250)->nullable()->default('');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_status');
    }
}
