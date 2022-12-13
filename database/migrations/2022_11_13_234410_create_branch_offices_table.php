<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_offices', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name', 255);
            $table->string('mobile', 255);
            $table->string('email', 255);
            $table->string('manager', 255);
            $table->timestamp('created')->nullable();
            $table->timestamp('modified')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('branch_offices');
    }
}
