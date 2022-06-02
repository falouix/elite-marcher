<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'السيد الشادلي الحاج علي',
        	'full_name' => 'السيد الشادلي الحاج علي',
        	'email' => 'echedli1@gmail.com',
        	'password' => bcrypt('09966822'),
            'user_type' => 'chairman',
        ]);

        $role = Role::create(['name' => 'superadmin',
        'name_ar'=>'مشرف عام',
        'guard_name'=>'web'
    ]);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
