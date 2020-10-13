<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_imgs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nickname')->nullable();
            $table->string('key')->nullable();
            $table->text('img_url');
            $table->string('language');
            $table->string('type');
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
        Schema::dropIfExists('site_imgs');
    }
}
