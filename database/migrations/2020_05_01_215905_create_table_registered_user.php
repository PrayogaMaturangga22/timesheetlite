<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRegisteredUser extends Migration
{
    public function up()
    {
        Schema::create('registered_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('total')->default(0);
            $table->string('status', 200)->default('');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registered_user');
    }
}
