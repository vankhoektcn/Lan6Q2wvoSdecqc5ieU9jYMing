<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 15)->index();
            $table->string('customer_name', 50);
            $table->string('customer_email', 50)->index();
            $table->string('customer_phone', 20)->index();
            $table->string('customer_address', 250);
            $table->string('customer_note', 300);
            $table->double('shipping_fee')->default(0);
            $table->integer('customer_id')->nullable();
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->integer('deleted_by')->nullable();
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
        Schema::drop('shopping_carts');
    }
}
