<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permission = Permission::create([
            'name' => "User settings",//can value
            'name_ar' => "اعدادات المستخدمين",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Managing tasks and powers",//can value
            'name_ar' => "إدارة المهام و الصلاحيات",//name_ar
        ]);

        $data = [
            [
                'name' => 'مدير النظام',
                'guard_name' => 'hospital',
            ]
        ];

        foreach ($data as $get)
        {
            Role::updateOrCreate($get);
        }

        $role = Role::first();
        // Assign Role To Admins
        $roleUsers = [
            [
                'role_id' => $role->id,
                'model_id' => 1,
                'model_type' => 'app\Models\Admin',
            ]
        ];

        foreach ($roleUsers as $get)
        {
            DB::table('model_has_roles')->updateOrInsert($get);
        }


        // Assign Role to Permissions

        if($role) {
            $permissions = Permission::get(['id']);
            foreach ($permissions as $get) {
                $item = [
                    'permission_id' => $get->id,
                    'role_id' => $role->id
                ];
                DB::table('role_has_permissions')->updateOrInsert($item);
            }
        }



    }
}
