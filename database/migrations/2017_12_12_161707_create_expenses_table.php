<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id')->unsigned();
            // Make foreign keys
            $table->foreign('category_id')->references('id')->on('taxonomy_terms');

            $table->date('transaction_date');
            $table->integer('amount');
            $table->string('memo', 255)->nullable();
            $table->boolean('exclude_from_budget');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
