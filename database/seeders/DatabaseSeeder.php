<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(PermissionSeed::class);
        $this->call(UsersTableSeeder::class);
        $this->call(InsertedDataSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(AddonSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(RestaurantSectionSeeder::class);
    }
}
