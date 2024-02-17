<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('musics', function (Blueprint $table) {
            $table->bigInteger('template_category_id')->unsigned()->after('id');
            $table->bigInteger('role_id')->unsigned()->after('template_category_id');
            $table->bigInteger('user_id')->unsigned()->after('role_id');
            $table->string('image')->nullable()->after('user_id');
            $table->string('artist')->nullable()->after('name');
            $table->text('description')->nullable()->after('artist');

            $table->foreign('template_category_id')
                ->references('id')
                ->on('template_categories')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
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
        Schema::table('musics', function (Blueprint $table) {
            // $table->dropForeign('musics_template_category_id_foreign');
            $table->dropForeign(['template_category_id']);
            $table->dropForeign(['role_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['template_category_id', 'role_id', 'user_id', 'image', 'artist', 'description']);
        });
    }
}
