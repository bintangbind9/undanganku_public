<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeToNullableParentNameOnBridesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brides', function (Blueprint $table) {
            $table->string('father')->nullable()->change();
            $table->string('mother')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brides', function (Blueprint $table) {
            $table->string('father')->nullable(false)->change();
            $table->string('mother')->nullable(false)->change();
        });
    }
}