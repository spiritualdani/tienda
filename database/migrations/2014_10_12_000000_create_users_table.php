<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;



class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rols', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });



        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rol_id');
            $table->string('name');
            $table->string('ci'); 
            $table->string('phone')->nullable(); 
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('rol_id')->references('id')->on('rols');

        });


        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');

            $table->string('name');
            $table->text('description')->nullable; 
            $table->integer('quantity'); 
            $table->string('picture')->nullable();
            $table->float('prize'); 
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');

        });


        Schema::create('sales', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); 
            $table->float('total_amount');
            $table->text('description')->nullable(); 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users'); 
        });



        Schema::create('products-sales', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sale_id'); 
            $table->unsignedBigInteger('product_id'); 

            $table->integer('quantity');
            $table->float('amount');
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales'); 
            $table->foreign('product_id')->references('id')->on('products'); 
        });

        DB::table('rols')->insert([
            'name' => 'superadmin', 
        ]);  

        DB::table('users')->insert([
            'name' => 'admin',
            'ci' => '123456',
            'phone' => '4269405',
            'email' => 'admin@admin.com', 
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'rol_id' => 1
        ]); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products-sales');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('products'); 
        Schema::dropIfExists('users'); 
        Schema::dropIfExists('categories'); 
        Schema::dropIfExists('rols'); 
    }
}
