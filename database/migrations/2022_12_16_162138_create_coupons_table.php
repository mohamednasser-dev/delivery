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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code',6)->unique();
            $table->date('from_date');
            $table->date('to_date');
            $table->enum('type',['percent','amount'])->default('percent');
            $table->double('amount');
            $table->double('min_order_price');
            $table->integer('active')->default(1);
            $table->integer('usage_count')->default(0);
            $table->integer('current_used')->default(0);
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
        Schema::dropIfExists('coupons');
    }
};
