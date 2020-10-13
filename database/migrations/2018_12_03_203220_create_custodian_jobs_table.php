<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustodianJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custodian_jobs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('message');
            $table->string('linkedin_url');

            $table->string('resume_url')->nullable();
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
        Schema::dropIfExists('custodian_jobs');
    }
}
