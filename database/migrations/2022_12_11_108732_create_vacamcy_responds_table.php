<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacamcyRespondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_responds', function (Blueprint $table) {
            $table->id();
            $table->integer('vacancy_id');
            $table->integer('user_id');
            $table->integer('cv_id');
            $table->smallInteger('status')->default(1)->comment('1-new, 10-invitation, 0-reject, 2-archive');
            $table->timestamps();


            $table->foreign('vacancy_id')->references('id')->on('vacancies')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('cv_id')->references('id')->on('applicant_cvs')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancy_responds');
    }
}
