<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRequestDemo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_demo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('request_date')->default('1900-01-01');
            $table->string('name', 200)->default('')->nullable();
            $table->string('company_name', 200)->default('')->nullable();
            $table->string('phone_number', 200)->default('')->nullable();
            $table->string('email', 200)->default('')->nullable();
            $table->string('message', 4000)->default('')->nullable();
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
        Schema::dropIfExists('request_demo');
    }
}
