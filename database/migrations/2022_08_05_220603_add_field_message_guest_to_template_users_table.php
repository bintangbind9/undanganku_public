<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldMessageGuestToTemplateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_users', function (Blueprint $table) {
            $table->text('message_guest')->nullable()->after('user_url');
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
            $table->dropColumn('message_guest');
        });
    }
}