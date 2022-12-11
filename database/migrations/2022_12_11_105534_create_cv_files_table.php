<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_files', function (Blueprint $table) {
            $table->id();
            $table->integer('cv_id');
            $table->string('name');
            $table->string('url');
            $table->string('type')->comment('profile, portfolio');
            $table->timestamps();

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
        Schema::dropIfExists('cv_files');
    }
}
