<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubscriptionStatus extends Migration
{
    public function up()
    {
        Schema::create('subscription_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 250)->nullable()->default(0);
            $table->string('color_code', 250)->nullable()->default('');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_status');
    }
}
