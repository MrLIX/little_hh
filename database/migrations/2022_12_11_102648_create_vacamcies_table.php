<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacamciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->integer('employer_id');
            $table->integer('location_id');
            $table->string('name');
            $table->double('salary')->nullable();
            $table->integer('work_experience')->nullable();
            $table->text('description');
            $table->boolean('is_online')->default(false);
            $table->string('working_hours')->nullable();
            $table->smallInteger('status')->default(10)->comment('10-active, 0-inactive');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('employer_id')->references('id')->on('employers')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('locations')
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
        Schema::dropIfExists('vacancies');
    }
}
