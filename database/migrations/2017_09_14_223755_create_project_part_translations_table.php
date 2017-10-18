<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectPartTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_part_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_part_id')->unsigned();
            $table->string('locale', 5);
            $table->string('name', 250);
            $table->string('summary', 500);
            $table->text('content');
            $table->string('meta_description', 500);
            $table->string('meta_keywords', 500);

            $table->unique(['project_part_id','locale']);
            $table->foreign('project_part_id')->references('id')->on('project_parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_part_translations');
    }
}
