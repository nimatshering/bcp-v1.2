<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGridsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grids', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('grid_no');
            $table->float('north_latitude',10,6);
            $table->float('north_longitude',10,6);
            $table->float('south_latitude',10,6);
            $table->float('south_longitude',10,6);
            $table->float('east_latitude',10,6);
            $table->float('east_longitude',10,6);
            $table->float('west_latitude',10,6);
            $table->float('west_longitude',10,6);
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
        Schema::dropIfExists('grids');
    }
}
