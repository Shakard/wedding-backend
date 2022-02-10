<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chairs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->bigInteger('table_id')->unsigned();
            $table->string('name');
            $table->string('code')->default('0');
            $table->timestamps();
        });

        Schema::table('chairs', function ($table) {
            $table->foreign('table_id')->references('id')->on('tables')->onDelete("cascade");
            $table->foreign('user_id')->references('id')->on('users')->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chairs');
    }
}
