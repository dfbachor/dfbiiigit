<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->increments('id');
            $table->date('creationDate');
            $table->string('companyName', 25);
            $table->string('companyPhone', 15);
            $table->string('email', 256);
            $table->tinyInteger('showCompleteGrows');
            $table->tinyInteger('showClosedTasks');
            $table->integer('maxPlantCount');
            $table->integer('maxBatchCount');
            $table->integer('maxBatchSize');
            $table->string('imageFileName', 256);
            $table->integer('hits');           
            $table->string('operatorUserName', 25);
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
        Schema::dropIfExists('systems');
    }
}
