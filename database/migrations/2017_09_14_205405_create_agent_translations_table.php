<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->unsigned();
            $table->string('locale', 5);
            $table->string('name', 250);
            $table->string('summary', 500);
            $table->string('meta_description', 500);
            $table->string('meta_keywords', 500);

            $table->unique(['agent_id','locale']);
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_translations');
    }
}
