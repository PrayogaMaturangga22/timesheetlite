<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSummarizedTable extends Migration
{
    public function up()
    {
        Schema::create('summarized_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('column_name', 250)->nullable()->default('');
            $table->integer('total')->default(0);
            $table->string('color_code', 250)->nullable()->default('');
            $table->string('column_desc', 250)->nullable()->default('');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('summarized_table');
    }
}
