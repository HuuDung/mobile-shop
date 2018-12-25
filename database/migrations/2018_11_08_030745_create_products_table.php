<?php

use Illuminate\Support\Facades\Schema;
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
            $table->integer('views')->default(0);
            $table->float('rate')->default(0);
            $table->integer('category_id');
            $table->longText('description')->nullable();
            $table->integer('cost');
            $table->string('image')->default('products/default.jpg');
            $table->integer('quantity');
            $table->integer('sold')->default(0);

            $table->integer('ram_id');
            $table->integer('system_id');
            $table->integer('storage_id');
            $table->integer('cpu_id');
            $table->float('screen_size');
            $table->float('weight');
            $table->softDeletes();
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
