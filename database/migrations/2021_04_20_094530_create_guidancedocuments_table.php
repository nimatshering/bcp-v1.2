<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuidancedocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guidancedocuments', function (Blueprint $table) {
            $table->id();
             $table->string('title');
            $table->string('slug');
            $table->string('author');
            $table->text('description');
            $table->string('document');
            $table->bigInteger('category_id');
            $table->timestamp('published_at');
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
        Schema::dropIfExists('guidancedocuments');
    }
}
