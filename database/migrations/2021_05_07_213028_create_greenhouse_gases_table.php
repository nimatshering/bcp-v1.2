<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGreenhousegasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('greenhousegas', function (Blueprint $table) {
            $table->id();
            $table->string('data_source');
            $table->bigInteger('year');
            $table->bigInteger('sector_id');
            $table->bigInteger('parameter_id');
            $table->double('data',8,2);
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('greenhousegas');
    }
}
