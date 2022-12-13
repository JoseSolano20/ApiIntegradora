<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id()->unique();
            $table->string('number');
            $table->string('name');
            $table->string('description',255);
            $table->double('price');
            $table->string('image')->nullable();
            $table->timestamp('created')->nullable();
            $table->timestamp('modified')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('status')->default(1);
           
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
