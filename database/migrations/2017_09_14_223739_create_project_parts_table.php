<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->index();
            // $table->string('name')->index();
            $table->string('key', 250)->index();
            $table->string('thumnail',500)->nullable();
            $table->string('link');
            $table->string('type',20)->default('E');
            $table->string('class')->default('scroll');
            $table->string('fa_icon')->nullable();
            /*$table->string('summary')->nullable();  
            $table->text('content');
            
            $table->string('meta_description', 500);
            $table->string('meta_keywords', 500);*/
            
            $table->integer('priority');
            $table->boolean('active')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_parts');
    }
}
