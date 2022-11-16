<?php
namespace Database\seeds;

use App\Models\Addon;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Restaurant::get() as $restaurant){

            Addon::create([
                'restaurant_id' => $restaurant->id,
                'active' => 1,
                'name_ar' => "باكت بطاطس",
                'name_en' => "Fries Packet",
            ]);

            Addon::create([
                'restaurant_id' => $restaurant->id,
                'active' => 1,
                'name_ar' => "صوص",
                'name_en' => "Sauce",
            ]);

            Addon::create([
                'restaurant_id' => $restaurant->id,
                'active' => 1,
                'name_ar' => "بيبسي",
                'name_en' => "Pepsi",
            ]);
        }
    }
}
