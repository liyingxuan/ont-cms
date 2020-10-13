<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_articles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();
//            $table->string('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('language')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('marketing_articles');
    }
}
