<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePublicHealthMonitoring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_health_monitoring', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();            
            $table->date('date');            
            $table->string('status', 100)->nullable()->default('');            
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
        Schema::dropIfExists('public_health_monitoring');
    }
}
