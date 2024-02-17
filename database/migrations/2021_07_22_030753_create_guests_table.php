<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('template_category_id')->unsigned();
            $table->string('name');
            $table->string('phone', 25)->nullable();
            $table->integer('presence')->default(0);
            $table->enum('status',['Y','N'])->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->foreign('template_category_id')
                ->references('id')
                ->on('template_categories')
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
        Schema::dropIfExists('guests');
    }
}
