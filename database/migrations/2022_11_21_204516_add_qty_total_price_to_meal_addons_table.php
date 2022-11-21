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
        Schema::table('meal_addons', function (Blueprint $table) {
            $table->bigInteger('qty')->default(1)->after('addon_id');
            $table->double('total_price',[8,2])->default(0)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meal_addons', function (Blueprint $table) {
            //
        });
    }
};
