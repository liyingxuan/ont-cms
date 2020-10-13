<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDappInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dapp_infos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->string('img_url')->nullable();
            $table->string('summary')->nullable();
            $table->longText('content')->nullable();

            $table->string('ont_id')->nullable();
            $table->longText('dapp_screen_urls')->nullable();
            $table->string('telegram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('discord')->nullable();

            $table->string('qq')->nullable();
            $table->string('github_url')->nullable();
            $table->string('contract_hash')->nullable();
            $table->string('abi')->nullable();
            $table->string('byte_code')->nullable();

            $table->string('token_name')->nullable();
            $table->string('token_type')->nullable();
            $table->string('donate_address')->nullable();
            $table->string('type')->nullable();
            $table->string('schedule')->nullable();


            $table->integer('priority')->nullable(); // 显示优先级
            $table->string('status')->nullable();

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
        Schema::dropIfExists('dapp_infos');
    }
}
