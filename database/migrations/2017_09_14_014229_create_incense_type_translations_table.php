<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncenseTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incense_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('incense_type_id')->unsigned();
            $table->string('locale', 5);
            $table->string('name', 250);
            $table->string('summary', 500);
            $table->string('meta_description', 500);
            $table->string('meta_keywords', 500);

            $table->unique(['incense_type_id','locale']);
            $table->foreign('incense_type_id')->references('id')->on('incense_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incense_type_translations');
    }
}
