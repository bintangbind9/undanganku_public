<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_types', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('event_type_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->dateTime('startdate')->nullable();
            $table->dateTime('enddate')->nullable();
            $table->string('place');
            $table->text('address');
            $table->text('map')->nullable();
            $table->timestamps();

            $table->foreign('event_type_id')
                ->references('id')
                ->on('event_types')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_types');
    }
}
