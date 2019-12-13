<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weathers', function (Blueprint $table) {
            $table->string('place');
            $table->string('weather');
            $table->string('weather_description');
            $table->string('weather_icon');
            $table->float('temp');
            $table->float('temp_max');
            $table->float('temp_min');
            $table->float('humidity');
            $table->float('wind_speed');
            $table->float('pressure');
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
        Schema::dropIfExists('weather');
    }
}
