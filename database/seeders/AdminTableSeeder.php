<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = Admin::create([
            'name' => 'Super Admin', 
            'email' => 'super-admin@gmail.com',
            'password' => bcrypt('1234!@#$')
        ]);
    
        $role = Role::create(['name' => 'Super-Admin']);
    
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $admin->assignRole([$role->id]);
    }
}
