<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldCountryCodeIdToGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->bigInteger('country_code_id')->unsigned()->after('template_category_id');

            $table->foreign('country_code_id')
                ->references('id')
                ->on('country_codes')
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
        Schema::table('guests', function (Blueprint $table) {
            $table->dropForeign(['country_code_id']);

            $table->dropColumn('country_code_id');
        });
    }
}