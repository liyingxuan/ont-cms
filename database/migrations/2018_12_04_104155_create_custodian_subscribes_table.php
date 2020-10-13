<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustodianSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custodian_subscribes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('email');
            $table->string('status');
            $table->string('processing_info')->nullable();
            $table->string('processing_person')->nullable();

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
        Schema::dropIfExists('custodian_subscribes');
    }
}
