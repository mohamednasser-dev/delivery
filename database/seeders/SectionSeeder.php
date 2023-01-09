<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name_ar' => "برجر",
                'name_en' => "burger",
            ],
            [
                'name_ar' => "فراخ",
                'name_en' => "chicken",
            ],
            [
                'name_ar' => "كريب",
                'name_en' => "crepe",
            ],
            [
                'name_ar' => "بطاطس",
                'name_en' => "fries",
            ],
            [
                'name_ar' => "هوت دوج",
                'name_en' => "hotdog",
            ],
            [
                'name_ar' => "مكرونة",
                'name_en' => "nodels",
            ]
        ];
        foreach ($data as $get) {
            Section::create($get);
        }
    }
}
