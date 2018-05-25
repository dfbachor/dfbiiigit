<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('systemID');
            $table->string('strainName');
            $table->string('testingStatus');
            $table->text('genetics');
            $table->integer('floweringTimeInDays');
            $table->string('operatorUserName')->nullable(true);
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
        Schema::dropIfExists('strains');
    }
}
