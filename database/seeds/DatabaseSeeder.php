<?php

use Database\Seeders\LinksSeeder;
use Database\Seeders\Pageseeder;
use Database\Seeders\ScreenSeeder;
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
    }
}
