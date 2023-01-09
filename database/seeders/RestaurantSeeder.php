<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!\App\Models\Restaurant::wherePhone("+9665050501")->first()) {
            \App\Models\Restaurant::updateOrCreate([
                "name_ar"=>"زاج زنجر1",
                "name_en"=>"zag zinger1",
                "crn"=>"2654151554105151",
                "restaurant_type_id"=>"1",
                "latitude"=>"30.0430715",
                "longitude"=>"31.4056989",
                "full_name"=>"mohamed nasser1",
                "national_id"=>"23111544445587771",
                "email"=>"zagzinger1@gmail.com",
                "nationality_id"=>"1",
                "phone"=>"+9665050501",
                "owner_type_id"=>"1",
            ]);
        }

        if (!\App\Models\Restaurant::wherePhone("+9665050502")->first()) {
            \App\Models\Restaurant::updateOrCreate([
                "name_ar"=>"زاج زنجر2",
                "name_en"=>"zag zinger2",
                "crn"=>"2654151554105151",
                "restaurant_type_id"=>"1",
                "latitude"=>"30.0430715",
                "longitude"=>"31.4056989",
                "full_name"=>"mohamed nasser2",
                "national_id"=>"23111544445587772",
                "email"=>"zagzinger2@gmail.com",
                "nationality_id"=>"1",
                "phone"=>"+9665050502",
                "owner_type_id"=>"1",
            ]);
        }

        if (!\App\Models\Restaurant::wherePhone("+9665050503")->first()) {
            \App\Models\Restaurant::updateOrCreate([
                "name_ar"=>"زاج زنجر3",
                "name_en"=>"zag zinger3",
                "crn"=>"2654151554105153",
                "restaurant_type_id"=>"1",
                "latitude"=>"30.0430715",
                "longitude"=>"31.4056989",
                "full_name"=>"mohamed nasser3",
                "national_id"=>"23111544445587773",
                "email"=>"zagzinger3@gmail.com",
                "nationality_id"=>"1",
                "phone"=>"+9665050503",
                "owner_type_id"=>"1",
            ]);
        }

    }
}
