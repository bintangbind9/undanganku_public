<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weddings', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('template_id')->unsigned();
            $table->string('photo_sampul')->nullable();
            $table->bigInteger('music_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('template_id')
                ->references('id')
                ->on('templates')
                ->onDelete('cascade');

            $table->foreign('music_id')
                ->references('id')
                ->on('musics')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weddings');
    }
}
