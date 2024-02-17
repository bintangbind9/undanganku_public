<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBridesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brides', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->enum('gender',['L','P']);
            $table->string('name');
            $table->string('nickname');
            $table->string('photo')->nullable();
            $table->text('about')->nullable();
            $table->string('father');
            $table->string('mother');
            $table->timestamps();

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
        Schema::dropIfExists('brides');
    }
}
