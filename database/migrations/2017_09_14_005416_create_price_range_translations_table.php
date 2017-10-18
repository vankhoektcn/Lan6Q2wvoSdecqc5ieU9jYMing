<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceRangeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_range_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price_range_id')->unsigned();
            $table->string('locale', 5);
            $table->string('name', 250);
            $table->string('summary', 500);
            $table->string('meta_description', 500);
            $table->string('meta_keywords', 500);

            $table->unique(['price_range_id','locale']);
            $table->foreign('price_range_id')->references('id')->on('price_ranges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_range_translations');
    }
}
