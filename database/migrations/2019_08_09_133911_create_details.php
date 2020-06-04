<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->string('about')->default('No Information');
            $table->string('id')->unique();
            $table->foreign('id')->references('id')->on('users')
                ->onDelete('cascade');            
            $table->string('address')->default('none');
            $table->string('study')->default('none');
            $table->string('work')->default('none');
            $table->string('hobbies')->default('none');
            $table->string('phone')->default('none');
            $table->string('state')->default('0');
            $table->string('date')->default('none');
            $table->boolean('mail')->default(false);
            $table->timestamps();

        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
        //
    }
}
