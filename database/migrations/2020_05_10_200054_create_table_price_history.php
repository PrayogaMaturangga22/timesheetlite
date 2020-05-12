<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePriceHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('change_date', 250)->nullable()->default(0);
            $table->decimal('from_price', 20, 2)->nullable()->default('0');
            $table->decimal('to_price', 20, 2)->nullable()->default('0');
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
        Schema::dropIfExists('price_history');
    }
}
