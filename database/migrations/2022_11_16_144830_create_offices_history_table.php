<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("history_id");
            $table->unsignedBigInteger("branch_offices_id");
            $table->foreign("history_id")->references('id')->on("history");
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
        Schema::dropIfExists('offices_history');
    }
}
