<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_levels', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->integer('level');
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::table('invoice_types', function (Blueprint $table) {
            $table->dropColumn('level');
            $table->bigInteger('invoice_level_id')->unsigned()->after('template_category_id');

            $table->foreign('invoice_level_id')
                ->references('id')
                ->on('invoice_levels')
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
        Schema::table('invoice_types', function (Blueprint $table) {
            $table->dropForeign(['invoice_level_id']);
            $table->dropColumn('invoice_level_id');
            $table->integer('level')->after('template_category_id');
        });

        Schema::dropIfExists('invoice_levels');
    }
}
