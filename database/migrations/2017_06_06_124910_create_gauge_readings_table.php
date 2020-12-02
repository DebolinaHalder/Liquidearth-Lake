<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaugeReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gauge_readings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gauge_inc_id');
            $table->float('height');
            $table->date('date');
            $table->time('time');
            $table->text('notes')->nullable;
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
        Schema::dropIfExists('gauge_readings');
    }
}
