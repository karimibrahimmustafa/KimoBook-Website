<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image');
            $table->string('cover')->default('upload/DefaultCover.jpg');
            $table->string('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('user_user', function (Blueprint $table) {

            $table->integer('user1_id')->unsigned();
        
            $table->integer('user2_id')->unsigned();
        
            $table->foreign('user1_id')->references('id')->on('users')
        
                ->onDelete('cascade');
        
            $table->foreign('user2_id')->references('id')->on('users')
        
                ->onDelete('cascade');
        
        });
        Schema::create('userWait', function (Blueprint $table) {

            $table->integer('user1_id')->unsigned();
        
            $table->integer('user2_id')->unsigned();
        
            $table->foreign('user1_id')->references('id')->on('users')
        
                ->onDelete('cascade');
        
            $table->foreign('user2_id')->references('id')->on('users')
        
                ->onDelete('cascade');
        
        });
        Schema::create('state', function (Blueprint $table) {

            $table->integer('id')->unsigned();
        
            $table->foreign('id')->references('id')->on('users')
        
                ->onDelete('cascade');
                $table->string('status')->default(0);
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_user');
        Schema::dropIfExists('userwait');
        Schema::dropIfExists('state');

    }
}
