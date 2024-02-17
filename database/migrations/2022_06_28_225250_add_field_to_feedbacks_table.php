<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->enum('is_shown_on_dashboard',['Y','N'])->default('Y')->after('ulasan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->dropColumn('is_shown_on_dashboard');
        });
    }
}