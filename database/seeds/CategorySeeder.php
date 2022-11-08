<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Restaurant::get() as $restaurant){

            Category::create([
                'restaurant_id' => $restaurant->id,
                'image' => null,
                'name_ar' => "وجبات",
                'name_en' => "Meals",
            ]);

            Category::create([
                'restaurant_id' => $restaurant->id,
                'image' => null,
                'name_ar' => "مشويات",
                'name_en' => "Grills",
            ]);

            Category::create([
                'restaurant_id' => $restaurant->id,
                'image' => null,
                'name_ar' => "سندوتشات",
                'name_en' => "Sandwiches",
            ]);
        }
    }
}
