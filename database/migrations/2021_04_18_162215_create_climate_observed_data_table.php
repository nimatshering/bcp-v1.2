<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimateObservedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('climate_observed_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('station_id');
            $table->double('data',8,2);
            $table->bigInteger('parameter_id');
            $table->date('date_of_reading');
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
        Schema::dropIfExists('climate_observed_data');
    }
}
