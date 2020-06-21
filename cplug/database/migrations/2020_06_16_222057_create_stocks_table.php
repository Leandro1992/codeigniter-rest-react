<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users') && Schema::hasTable('products')) {
            Schema::create('stocks', function (Blueprint $table) {
                $table->id();
                $table->enum('type', ['in', 'out']);
                $table->integer('quantity');
                $table->foreignId('user_id');
                $table->foreignId('product_id');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('product_id')->references('id')->on('products');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
