<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_categories', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('templates', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('template_category_id')->unsigned();
            $table->string('name');
            $table->string('photo');
            $table->timestamps();

            $table->foreign('template_category_id')
                ->references('id')
                ->on('template_categories')
                ->onDelete('cascade');
        });

        Schema::create('template_users', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('template_category_id')->unsigned();
            $table->string('user_url')->unique();
            $table->enum('status',['Y','N'])->default('N');
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
        // Schema::table('templates', function (Blueprint $table) {
        //     $table->dropForeign('templates_template_category_id_foreign');
        // });
        Schema::dropIfExists('template_users');
        Schema::dropIfExists('templates');
        Schema::dropIfExists('template_categories');
    }
}
