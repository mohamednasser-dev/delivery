<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_meal_attribute_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreignId('restaurant_id')->nullable()->references('id')->on('restaurants')->onDelete('set null');
            $table->foreignId('meal_attribute_id')->references('id')->on('meal_attributes')->onDelete('cascade');
            $table->foreignId('order_meal_attribute_id')->references('id')->on('order_meal_attributes')->onDelete('cascade');
            $table->foreignId('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->string('name_ar');
            $table->string('name_en');
            $table->double('price',[8,2])->default(0);
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
        Schema::dropIfExists('order_meal_attribute_options');
    }
};
