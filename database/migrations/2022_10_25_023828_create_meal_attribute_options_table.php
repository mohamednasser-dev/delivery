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
        Schema::create('meal_attribute_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreignId('meal_attribute_id')->references('id')->on('meal_attributes')->onDelete('cascade');
            $table->foreignId('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->double('price',[8,2])->default(0);
            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('meal_attribute_options');
    }
};
