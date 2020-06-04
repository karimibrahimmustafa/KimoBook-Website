<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('groups', function (Blueprint $table) {
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
    Schema::create('user_group_add', function (Blueprint $table) {
        $table->integer('group_id')->unsigned();
    
        $table->integer('user_id')->unsigned();
    
        $table->foreign('group_id')->references('id')->on('groups')
    
            ->onDelete('cascade');
    
        $table->foreign('user_id')->references('id')->on('users')
    
            ->onDelete('cascade');
        $table->timestamps();
    });
    Schema::create('user_group', function (Blueprint $table) {
        $table->integer('group_id')->unsigned();
    
        $table->integer('user_id')->unsigned();
    
        $table->foreign('group_id')->references('id')->on('groups')
    
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
    Schema::dropIfExists('groups');
    Schema::dropIfExists('user_group');
    Schema::dropIfExists('user_group_add');
}

}
