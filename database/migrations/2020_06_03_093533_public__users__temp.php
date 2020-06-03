<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PublicUsersTemp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_users_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 100)->default('')->nullable();
            $table->string('email', 100)->default('')->nullable();
            $table->string('password', 100)->default('')->nullable();
            $table->string('token', 191)->default('')->nullable();
            $table->datetime('expired_at');
            $table->datetime('sent_at')->nullable();
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
        Schema::dropIfExists('public_users_temp');
    }
}
