<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('logo', 100)->nullable();
            $table->string('phone_number', 11);
            $table->string('store_manager', 100);
            $table->string('status',1)->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('city_id');

            $table->foreign("user_id")
            ->references("id")
            ->on("users")
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('city_id')
            ->references('id')
            ->on('iran_cities')
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
        Schema::dropIfExists('restaurants');
    }
}
