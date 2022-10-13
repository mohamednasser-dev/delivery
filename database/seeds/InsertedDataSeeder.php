<?php

use Illuminate\Database\Seeder;
use App\Models\OwnerType;
use App\Models\RestaurantType;
use \App\Models\Nationality;
class InsertedDataSeeder extends Seeder
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
                'id' => 1,
                'name_ar' => 'مالك',
                'name_en' => 'owner',
            ],
            [
                'id' => 2,
                'name_ar' => 'شريك',
                'name_en' => 'partner',
            ],
            [
                'id' => 3,
                'name_ar' => 'مدير',
                'name_en' => 'manager',
            ],
        ];
        foreach ($data as $row){
            OwnerType::updateOrCreate($row);
        }

        $data = [
            [
                'id' => 1,
                'name_ar' => 'مطعم',
                'name_en' => 'restaurant',
            ],
            [
                'id' => 2,
                'name_ar' => 'قهوه',
                'name_en' => 'cafe',
            ],
            [
                'id' => 3,
                'name_ar' => 'فندق',
                'name_en' => 'hotel',
            ],
        ];
        foreach ($data as $row){
            RestaurantType::updateOrCreate($row);
        }

        if(Nationality::get()->count() == 0){
            $path = public_path('sql/nationalities.sql');
            $sql = file_get_contents($path);
            DB::unprepared($sql);
        }
    }
}
