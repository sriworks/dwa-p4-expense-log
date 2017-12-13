<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomyTermsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('taxonomy_terms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('term', 255);
            $table->integer('taxonomy_id')->unsigned();
            // Assign foreign key constraint.
            $table->foreign('taxonomy_id')->references('id')->on('taxonomies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('taxonomy_terms');
    }
}
