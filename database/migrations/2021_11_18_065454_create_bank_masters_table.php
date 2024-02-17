<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_masters', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('code', 5)->unique();
            $table->string('name');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('bank_func_categories', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name')->unique();
            $table->text('desc');
            $table->timestamps();
        });
        
        Schema::create('currencies', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('code', 3)->unique();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('bank_func_category_id')->unsigned();
            $table->bigInteger('bank_master_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('number');
            $table->string('name');
            $table->bigInteger('currency_id')->unsigned();
            $table->enum('status',['Y','N'])->default('Y');
            $table->timestamps();

            $table->foreign('bank_func_category_id')
                ->references('id')
                ->on('bank_func_categories')
                ->onDelete('cascade');

            $table->foreign('bank_master_id')
                ->references('id')
                ->on('bank_masters')
                ->onDelete('cascade');
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies')
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
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('bank_func_categories');
        Schema::dropIfExists('bank_masters');
    }
}
