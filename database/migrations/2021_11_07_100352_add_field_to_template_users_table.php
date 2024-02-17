<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToTemplateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_users', function (Blueprint $table) {
            $table->id()->unsigned()->first();
        });

        Schema::table('templates', function (Blueprint $table) {
            $table->bigInteger('invoice_type_id')->unsigned()->after('template_category_id');

            $table->foreign('invoice_type_id')
                ->references('id')
                ->on('invoice_types')
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
        Schema::table('template_users', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        Schema::table('templates', function (Blueprint $table) {
            $table->dropForeign(['invoice_type_id']);

            $table->dropColumn('invoice_type_id');
        });
    }
}
