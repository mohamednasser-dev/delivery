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
            $table->string('logo');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('crn')->nullable();
            $table->foreignId('restaurant_type_id')->references('id')->on('restaurant_types')->onDelete('restrict');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('full_name');
            $table->string('national_id');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone')->unique();
            $table->foreignId('nationality_id')->references('id')->on('nationalities')->onDelete('restrict');
            $table->foreignId('owner_type_id')->references('id')->on('owner_types')->onDelete('restrict');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status', ['new', 'accepted', 'rejected'])->default('new');
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
        Schema::dropIfExists('restaurants');
    }
}
