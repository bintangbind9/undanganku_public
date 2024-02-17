<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestPresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_presences', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('guest_id')->unsigned();
            $table->integer('presence');
            $table->date('date');
            $table->time('time');
            $table->timestamps();

            $table->foreign('guest_id')
                ->references('id')
                ->on('guests')
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
        Schema::dropIfExists('guest_presences');
    }
}
