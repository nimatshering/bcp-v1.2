<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisasterDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disaster_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dzongkhag_id');
            $table->bigInteger('type_id');
            $table->Date('disaster_date');
            $table->string('report_link');
            $table->string('data_source');
            $table->text('remarks');
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
        Schema::dropIfExists('disaster_data');
    }
}
