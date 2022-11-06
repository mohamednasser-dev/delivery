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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_num')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('restaurants_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->dateTime('on_pocessing')->nullable();
            $table->dateTime('on_delivery')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->enum('cancelled_by',['user','restaurant'])->nullable();
            $table->text('cancele_reason')->nullable();
            $table->double('discount_price')->default(0);
            $table->double('total_price')->default(0);
            $table->string('in_lat')->nullable();
            $table->string('in_lng')->nullable();
            $table->string('in_location')->nullable();
            $table->string('out_lat')->nullable();
            $table->string('out_lng')->nullable();
            $table->string('out_location')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
