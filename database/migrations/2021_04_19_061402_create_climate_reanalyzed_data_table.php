<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimateReanalyzedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('climate_reanalyzed_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('grid_id');
            $table->double('data',8,2);
            $table->string('data_source');
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
        Schema::dropIfExists('climate_reanalyzed_data');
    }
}
