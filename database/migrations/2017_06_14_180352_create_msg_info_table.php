<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsgInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('msg_service_id');
            $table->string('msg_from');
            $table->string('body');
            $table->string('msg_stauts');
            $table->string('error_code')->default(null);
            $table->string('from_city');
            $table->string('from_state');
            $table->string('from_zip');
            $table->integer('is_format_valid');
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
        Schema::dropIfExists('sms_informations');
    }
}
