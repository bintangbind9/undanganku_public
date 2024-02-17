<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_payments', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('invoice_id')->unsigned();
            $table->dateTime('date');
            $table->double('amount', 12, 2);
            $table->string('attachment');
            $table->enum('is_confirmed',['Y','N'])->default('N');
            $table->timestamps();

            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('cascade');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('attachment');
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
            $table->string('attachment')->nullable()->after('amount');
        });

        Schema::dropIfExists('invoice_payments');
    }
}
