<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credentials', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name', 255);
            $table->timestamp('created')->nullable();
            $table->timestamp('modified')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger("user_id");
        });

        Schema::table('credentials', function (Blueprint $table) {
            $table->foreign("user_id")->references('id')->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credentials');
    }
}
