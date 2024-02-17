<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldHighlightToInvoiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_types', function (Blueprint $table) {
            $table->enum('highlight',['Y','N'])->default('N')->after('expired_day');
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
            $table->dropColumn('highlight');
        });
    }
}
