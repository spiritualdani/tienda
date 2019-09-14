<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->string('name')->nullable(); 
            $table->string('ci')->nullable(); 
            $table->string('phone')->nullable(); 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('sales', function (Blueprint $table){
    
            $table->unsignedBigInteger('client_id')->after('user_id')->nullable();

            $table->foreign('client_id')->references('id')->on('clients');
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table){
    
            $table->dropColumn('client_id');

        });

        Schema::dropIfExists('clients');
    }

}
