<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('admin');
            $table->string('image');
            $table->string('about');
            $table->string('discription');
            $table->string('contacts');
            $table->string('keys');
            $table->string('from');
            $table->string('to');
            $table->string('type');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id');
            $table->string('user_id');
            $table->string('price');
            $table->string('text');
            $table->string('type');
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('products');
        Schema::dropIfExists('offers');
    }
}
