<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('post_id');
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade');
            $table->string('user');
            $table->foreign('user')->references('id')->on('users')
                    ->onDelete('cascade');
            $table->string('type');
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
        Schema::dropIfExists('likes');
    }
}
