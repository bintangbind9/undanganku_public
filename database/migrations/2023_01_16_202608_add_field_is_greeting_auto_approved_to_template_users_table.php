<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldIsGreetingAutoApprovedToTemplateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_users', function (Blueprint $table) {
            $table->enum('is_greeting_auto_approved',['Y','N'])->default('Y')->after('message_guest');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_users', function (Blueprint $table) {
            $table->dropColumn('is_greeting_auto_approved');
        });
    }
}
