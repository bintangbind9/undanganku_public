<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToGreetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('greetings', function (Blueprint $table) {
            $table->enum('is_shown_on_dashboard',['Y','N'])->default('Y')->after('greeting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('greetings', function (Blueprint $table) {
            $table->dropColumn('is_shown_on_dashboard');
        });
    }
}