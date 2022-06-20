<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FoodFeatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_features', function (Blueprint $table) {
            $table->id();
            $table->string('material', 100)->nullable();
            $table->string('price',7);
            $table->unsignedBigInteger('food_id');
        
            $table->foreign('food_id')
            ->references('id')
            ->on('foods')
            ->onDelete('cascade');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_features');
    }
}
