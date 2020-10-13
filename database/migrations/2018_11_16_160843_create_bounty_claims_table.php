<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBountyClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bounty_claims', function (Blueprint $table) {
            $table->increments('id');

            $table->increments('bounty_id');
            $table->string('name');
            $table->string('email');
            $table->string('github_url');
            $table->string('completion_time'); // 完成所需天数

            $table->text('team')->nullable();
            $table->text('plan')->nullable();
            $table->string('status');

            // 项目开始之后：
            $table->string('team_alias')->nullable();
            $table->string('bounty_name_alias')->nullable();
            $table->string('project_url')->nullable();
            $table->string('schedule')->nullable();

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
        Schema::dropIfExists('bounty_claims');
    }
}
