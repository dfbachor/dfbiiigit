<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_likes', function (Blueprint $table) {
            $table->integer('noteID')->unsigned();
            $table->integer('likeUserID')->unsigned();

            $table->timestamps();

            $table->foreign('noteID')->references('id')->on('notes')->onDelete('CASCADE');
            $table->foreign('likeUserID')->references('id')->on('users')->onDelete('CASCADE');

            $table->primary(['noteID', 'likeUserID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_comment');
    }
}
