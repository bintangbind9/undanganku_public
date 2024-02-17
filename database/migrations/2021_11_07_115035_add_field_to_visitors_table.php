<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->bigInteger('guest_id')->unsigned()->nullable()->after('template_category_id');
            $table->string('name')->default('unknown')->after('guest_id');
            $table->string('fullname')->default('-')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn(['guest_id', 'name', 'fullname']);
        });
    }
}
