<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\RestaurantSection;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (Restaurant::get() as $restaurant) {
            foreach (Section::get() as $section) {
                RestaurantSection::create([
                    'restaurant_id' => $restaurant->id,
                    'section_id' => $section->id,
                ]);
            }
        }
    }
}
