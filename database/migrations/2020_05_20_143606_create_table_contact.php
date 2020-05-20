<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('contact_date')->default('1900-01-01');
            $table->string('first_name', 200)->default('')->nullable();
            $table->string('last_name', 200)->default('')->nullable();
            $table->string('email', 200)->default('')->nullable();
            $table->string('title', 1000)->default('')->nullable();
            $table->string('message', 8000)->default('')->nullable();
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
        Schema::dropIfExists('contact');
    }
}
