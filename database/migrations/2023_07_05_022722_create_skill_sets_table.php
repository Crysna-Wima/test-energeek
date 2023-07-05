<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_sets', function (Blueprint $table) {
            // add pk and fk from jobs table and skills table
            $table->integer('candidate_id')->unsigned();
            $table->integer('skill_id')->unsigned();
            // set job_id and skill_id as primary key
            $table->primary(['candidate_id', 'skill_id']);
            $table->index('candidate_id');
            $table->index('skill_id');
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('skill_id')->references('id')->on('skills');
            // add unique constraint to job_id and skill_id
            $table->unique(['candidate_id', 'skill_id'], 'candidate_skill_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_sets');
    }
}
