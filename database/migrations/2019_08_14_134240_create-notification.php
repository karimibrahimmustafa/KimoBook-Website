<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('user');
            $table->foreign('user')->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('type')->default(0);
            $table->string('text')->default("");
            $table->string('post_id')->default(null);
            $table->string('from_id')->default(null);
            $table->boolean('read');
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
        Schema::dropIfExists('notifications');
    }
    }