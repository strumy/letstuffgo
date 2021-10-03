<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description');
            $table->string('sku', 20)->unique();
            $table->float('price', 8, 2);
            $table->enum('status', ['POSTED', 'PUBLISHED', 'BLOCKED', 'RESERVED', 'SOLD', 'UNAVAILABLE', 'RETURNED'])->default('POSTED');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categorys')->onDelete('cascade');

            $table->dateTime('publish_date')->nullable($value = true);
            $table->dateTime('blocking_date')->nullable($value = true);

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
        Schema::dropIfExists('products');
    }
}
