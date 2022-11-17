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
        Schema::table('restaurants', function (Blueprint $table) {
            $table->double('commission')->default(0)->comment('By percent %');
            $table->double('min_order_price')->default(0);
            $table->double('tax')->default(0)->comment('By percent %');
            $table->integer('min_delivery_time')->default(0)->comment('by minutes');
            $table->integer('max_delivery_time')->default(0)->comment('by minutes');
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('free_delivery')->default(1);
            $table->double('min_shipping_charge')->default(0);
            $table->double('rating')->default(0);
            $table->double('total_earning')->default(0);
            $table->double('total_withdrawn')->default(0);
            $table->double('pending_withdraw')->default(0);
            $table->double('collected_cash')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            //
        });
    }
};
