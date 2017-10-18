<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function (Blueprint $table) {
			$table->increments('id');
            
            $table->string('key', 250)->index();
            $table->integer('project_type_id')->index();
            $table->integer('province_id')->index()->nullable();
            $table->integer('district_id')->index()->nullable();            
            $table->integer('ward_id')->nullable()->nullable();
            $table->integer('street_id')->nullable(); 
            $table->string('address', 250)->nullable();
            $table->string('hotline',50)->nullable(); 
            $table->string('email',100)->nullable();    
            $table->boolean('show_slide')->default(1)->nullable();
            $table->string('map_latitude',50)->nullable();  
            $table->string('map_longitude',50)->nullable();
            $table->string('website',500)->nullable();
            /*$table->text('content')->nullable();
            $table->string('meta_description', 500);
            $table->string('meta_keywords', 500);*/

            $table->integer('priority');
            $table->boolean('published')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
			$table->integer('published_by')->nullable();
			$table->dateTime('published_at')->nullable();
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
		Schema::drop('projects');
	}
}
