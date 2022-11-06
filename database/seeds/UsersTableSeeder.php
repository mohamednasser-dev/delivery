<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::first();
        if (!User::find(1)) {
            User::updateOrCreate([
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => '123456',
                'role_id' => $role->id,
                'type' => 'admin',
            ]);
        }

        if (!User::find(2)) {
            User::updateOrCreate([
                'id' => 2,
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => '123456',
                'type' => 'user',
            ]);
        }

        if (!User::find(3)) {
            User::updateOrCreate([
                'id' => 3,
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => '123456',
                'type' => 'user',
            ]);
        }

        if (!User::find(4)) {
            User::updateOrCreate([
                'id' => 4,
                'name' => 'user3',
                'email' => 'user3@gmail.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => '123456',
                'type' => 'user',
            ]);
        }

    }
}
