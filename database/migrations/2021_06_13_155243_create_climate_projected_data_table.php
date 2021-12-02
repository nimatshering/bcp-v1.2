<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimateProjectedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('climate_projected_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('station_id');
            $table->bigInteger('parameter_id');
            $table->bigInteger('model_id');
            $table->bigInteger('scenerio_id');
            $table->Date('date_of_reading');
            $table->double('data',8,2);
            $table->string('data_source');
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
        Schema::dropIfExists('climate_projected_data');
    }
}
