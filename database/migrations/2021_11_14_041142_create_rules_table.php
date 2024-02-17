<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('template_category_id')->unsigned();
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('status',['Y','N'])->default('Y');
            $table->timestamps();

            $table->foreign('template_category_id')
                ->references('id')
                ->on('template_categories')
                ->onDelete('cascade');
        });

        Schema::create('rule_values', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('template_category_id')->unsigned();
            $table->bigInteger('rule_id')->unsigned();
            $table->bigInteger('invoice_type_id')->unsigned();
            $table->string('value');
            $table->timestamps();

            $table->foreign('template_category_id')
                ->references('id')
                ->on('template_categories')
                ->onDelete('cascade');

            $table->foreign('rule_id')
                ->references('id')
                ->on('rules')
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
        Schema::dropIfExists('rule_values');
        Schema::dropIfExists('rules');
    }
}
