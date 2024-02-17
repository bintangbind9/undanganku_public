<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldBankAccountIdToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->bigInteger('bank_account_id')->unsigned()->after('invoice_type_id');

            $table->foreign('bank_account_id')
                ->references('id')
                ->on('bank_accounts')
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
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['bank_account_id']);

            $table->dropColumn('bank_account_id');
        });
    }
}
