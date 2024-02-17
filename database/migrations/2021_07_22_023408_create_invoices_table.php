<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('template_category_id')->unsigned();
            $table->bigInteger('invoice_type_id')->unsigned();
            $table->string('code')->unique();
            $table->dateTime('expired')->nullable();
            $table->double('amount', 12, 2);
            $table->string('attachment')->nullable();
            $table->enum('status',['Y','N'])->default('N');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->foreign('template_category_id')
                ->references('id')
                ->on('template_categories')
                ->onDelete('cascade');

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
        Schema::dropIfExists('invoices');
    }
}
