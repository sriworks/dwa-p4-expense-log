<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseTaxonomyTermTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('expense_taxonomy_term', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('expense_id')->unsigned();
            $table->integer('taxonomy_term_id')->unsigned();

            // Make foreign keys
            $table->foreign('expense_id')->references('id')->on('expenses');
            $table->foreign('taxonomy_term_id')->references('id')->on('taxonomy_terms');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('expense_taxonomy_term');
    }
}
