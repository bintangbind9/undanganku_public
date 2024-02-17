<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToGuestPresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest_presences', function (Blueprint $table) {
            $table->enum('is_shown',['Y','N'])->default('N')->after('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_presences', function (Blueprint $table) {
            $table->dropColumn('is_shown');
        });
    }
}