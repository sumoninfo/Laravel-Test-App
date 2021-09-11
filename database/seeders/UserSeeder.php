<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Super admin
        User::factory()->create([
            'name'  => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
        ]);
        // Create admin
        $admin      = User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@gmail.com',
        ]);
        $admin_role = Role::where(['name' => "Admin"])->first();
        $admin->assignRole($admin_role->name);

        // Create Sub admin
        $sub_admin = User::factory()->create([
            'name'  => 'SubAdmin',
            'email' => 'subadmin@gmail.com',
        ]);
        $sub_role  = Role::where(['name' => "SubAdmin"])->first();
        $sub_admin->assignRole($sub_role->name);
    }
}
