<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductposttable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('upc');
            $table->string('productname');
            $table->string('sku');
            $table->string('image')->nullable();
            $table->double('Price')->default(0.00);
            $table->double('tax')->default(0.00);
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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('upc');
            $table->string('productname');
            $table->string('sku');
            $table->string('image')->nullable();
            $table->double('Price')->default(0.00);
            $table->double('tax')->default(0.00);
            $table->timestamps();
            });
    }
}
