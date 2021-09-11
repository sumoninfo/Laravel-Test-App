<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //role
            ['name' => 'role-list'],
            ['name' => 'role-create'],
            ['name' => 'role-edit'],
            ['name' => 'role-delete'],
            //user
            ['name' => 'user-list'],
            ['name' => 'user-create'],
            ['name' => 'user-edit'],
            ['name' => 'user-delete'],
            //product
            ['name' => 'product-list'],
            ['name' => 'product-create'],
            ['name' => 'product-edit'],
            ['name' => 'product-delete']
        ];

        $permission_admin_ids     = [];
        $permission_sub_admin_ids = [];
        $time_stamp               = Carbon::now()->toDateTimeString();
        $sub_admin_permissions    = ['list', 'edit'];
        //Permission creating
        foreach ($permissions as $permission) {
            $obj             = new Permission();
            $obj->name       = $permission['name'];
            $obj->created_at = $time_stamp;
            $obj->save();
            //admin permissions ids
            array_push($permission_admin_ids, $obj->id);

            //sub admin permissions ids
            if (in_array(explode('-', $permission['name'])[1], $sub_admin_permissions)) {
                array_push($permission_sub_admin_ids, $obj->id);
            }
        }
        //Admin role create with permission assign
        $doctor_role = Role::create(['name' => 'Admin']);
        $doctor_role->syncPermissions($permission_admin_ids);

        //Sub admin create with permission assign
        $patient_role = Role::create(['name' => 'SubAdmin']);
        $patient_role->syncPermissions($permission_sub_admin_ids);
    }
}
