<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessage extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->string('from_id');
            $table->foreign('from_id')->references('id')->on('users')
                ->onDelete('cascade'); 
            $table->string('to_id');  
            $table->foreign('to_id')->references('id')->on('users')
                ->onDelete('cascade');          
            $table->string('image')->default(null);
            $table->string('text');
            $table->boolean('read');
            $table->timestamps();

        });   
        Schema::create('runnig message', function (Blueprint $table) {
            $table->string('from_id');
            $table->foreign('from_id')->references('id')->on('users')
                ->onDelete('cascade'); 
            $table->string('to_id');  
            $table->foreign('to_id')->references('id')->on('users')
                ->onDelete('cascade');          
            $table->string('status');
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
        Schema::dropIfExists('messages');
        Schema::dropIfExists('runnig messages');

    }
}
