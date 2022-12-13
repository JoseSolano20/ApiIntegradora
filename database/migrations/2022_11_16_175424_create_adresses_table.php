<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('street', 255);
            $table->string('ext', 255);
            $table->string('int', 255);
            $table->string('zip', 255);
            $table->string('suburb', 255);
            $table->string('deputation', 255);
            $table->string('state', 255);
            $table->string('country', 255);
            $table->timestamp('created')->nullable();
            $table->timestamp('modified')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger("branch_offices_id");
        });

        Schema::table('adresses', function (Blueprint $table) {
            $table->foreign("branch_offices_id")->references('id')->on("branch_offices");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adresses');
    }
}
