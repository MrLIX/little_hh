<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_cvs', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->integer('work_experience')->nullable();
            $table->double('salary')->nullable();
            $table->text('description')->nullable();
            $table->text('about_me')->nullable();
            $table->boolean('is_online');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('application_id')->references('id')->on('applicants')
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
        Schema::dropIfExists('applicant_cvs');
    }
}
