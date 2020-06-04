<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('post_id');
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade');
            $table->string('user');
            $table->foreign('user')->references('id')->on('users')
                    ->onDelete('cascade');
            $table->string('text');
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
        Schema::dropIfExists('comments');
    }
}
