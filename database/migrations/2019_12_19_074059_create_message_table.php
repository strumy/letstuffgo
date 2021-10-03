<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('recepient_id');
            $table->foreign('recepient_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->string('location');
            $table->longText('content');

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
        Schema::dropIfExists('message');
    }
}
