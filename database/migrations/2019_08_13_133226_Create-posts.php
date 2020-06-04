<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('user');
            $table->string('page_id')->default(0);;
            $table->string('group_id')->default(0);;
            $table->foreign('user')->references('id')->on('users')
                ->onDelete('cascade');
           $table->foreign('page_id')->references('id')->on('pages')
                ->onDelete('cascade'); 
            $table->foreign('group_id')->references('id')->on('groups')
                  ->onDelete('cascade');
            $table->string('image')->default(null);
            $table->string('text');
            $table->string('shared')->default(0);
            $table->boolean('read');
            $table->boolean('page')->default(false);
            $table->boolean('group')->default(false);;
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
        Schema::dropIfExists('posts');
    }
}
