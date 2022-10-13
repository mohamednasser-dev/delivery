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
        User::updateOrCreate([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => '123456',
            'role_id' => $role->id,
        ]);
    }
}
