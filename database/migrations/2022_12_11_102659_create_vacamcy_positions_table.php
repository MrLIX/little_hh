<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacamcyPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_references', function (Blueprint $table) {
            $table->id();
            $table->integer('vacancy_id');
            $table->integer('reference_id');
            $table->string('reference_type')->comment('positions, skills');
            $table->timestamps();

            $table->foreign('vacancy_id')->references('id')->on('vacancies')
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
        Schema::dropIfExists('vacancy_references');
    }
}
