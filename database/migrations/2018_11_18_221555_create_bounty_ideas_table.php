<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBountyIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bounty_ideas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('email');
            $table->string('programming_lang');
            $table->string('budget_requested'); // 申请预算
            $table->string('completion_time'); // 完成时间

            $table->text('summary');
            $table->text('content');

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
        Schema::dropIfExists('bounty_ideas');
    }
}
