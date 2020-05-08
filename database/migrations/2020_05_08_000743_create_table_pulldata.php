<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePulldata extends Migration
{
    public function up()
    {
        Schema::create('pulldata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('table_name', 250)->nullable()->default(0);
            $table->datetime('last_pull_date')->default('1900-01-01');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pulldata');
    }
}