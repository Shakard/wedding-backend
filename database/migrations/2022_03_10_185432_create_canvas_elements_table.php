<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanvasElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canvas_elements', function (Blueprint $table) {
            $table->engine="innoDB";
            $table->id();
            $table->string('name');            
            $table->string('code')->default('0');
            $table->bigInteger('catalogue_id')->unsigned()->nullable();
            $table->integer('pos_x')->nullable();
            $table->integer('pos_y')->nullable();
            $table->timestamps();

            $table->foreign('catalogue_id')->references('id')->on('catalogues')->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canvas_elements');
    }
}
