<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaugesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gauges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gauge_id')->unique();
            $table->string('name');
            $table->string('city');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('timezone');
            $table->string('unit');
            $table->dateTime('installation_date');
            $table->float('initial_reading');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('gauges');
    }
}
