<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestnetTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testnet_tokens', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('ont');
            $table->string('ong');

            $table->string('address');
            $table->string('project_url');
            $table->string('plan');
            $table->string('team');

            $table->string('status');

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
        Schema::dropIfExists('testnet_tokens');
    }
}
