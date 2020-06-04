<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('admin');
            $table->string('image');
            $table->string('about');
            $table->string('keys');
            $table->string('cover')->default('upload/DefaultCover.jpg');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('user_page', function (Blueprint $table) {
            $table->integer('page_id')->unsigned();
        
            $table->integer('user_id')->unsigned();
        
            $table->foreign('page_id')->references('id')->on('pages')
        
                ->onDelete('cascade');
        
            $table->foreign('user_id')->references('id')->on('users')
        
                ->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('user_follow', function (Blueprint $table) {
            $table->integer('page_id')->unsigned();
        
            $table->integer('user_id')->unsigned();
        
            $table->foreign('page_id')->references('id')->on('pages')
        
                ->onDelete('cascade');
        
            $table->foreign('user_id')->references('id')->on('users')
        
                ->onDelete('cascade');
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
        Schema::dropIfExists('pages');
        Schema::dropIfExists('user_page');
        Schema::dropIfExists('user_follow');
    }
}
