<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FoodsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('foods_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('foods_id')
            ->references('id')
            ->on('foods')
            ->onDelete('cascade');
        

            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade');
        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods_categories');
    }
}
