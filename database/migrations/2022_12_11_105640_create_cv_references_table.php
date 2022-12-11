<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_references', function (Blueprint $table) {
            $table->id();
            $table->integer('cv_id');
            $table->integer('reference_id');
            $table->string('reference_type')->comment('positions, skills, languages, socials');
            $table->string('value')->nullable()->comment('url for socials, level for language');
            $table->timestamps();

            $table->foreign('cv_id')->references('id')->on('applicant_cvs')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('reference_id')->references('id')->on('references')
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
        Schema::dropIfExists('cv_references');
    }
}
