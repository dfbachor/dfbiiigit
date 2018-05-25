<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('systemID');
            $table->boolean('independentFromBatch');
            $table->integer('batchID');
            $table->string('type');
            $table->integer('strainID');
            $table->integer('cloneParentID')->nullable();
            $table->integer('stageID');
            $table->integer('roomID');
            $table->integer('mediumID');
            $table->date('startDate');
            $table->date('cycleChangeDate')->nullable();
            $table->date('harvestDate')->nullable();
            $table->date('completeDate')->nullable();
            $table->float('yield')->nullable();
            $table->string('imageFileName')->nullable(true);
            $table->string('operatorUserName');
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
        Schema::dropIfExists('plants');
    }
}
