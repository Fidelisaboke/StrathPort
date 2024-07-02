<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        Permission::create(['name' => 'view transport schedules']);
        Permission::create(['name' => 'view carpool schedules']);
        Permission::create(['name' => 'edit transport request']);
        Permission::create(['name' => 'edit carpool request']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'edit carpool vehicles']);
        Permission::create(['name' => 'edit school vehicles']);
        Permission::create(['name' => 'edit school drivers']);
        Permission::create(['name' => 'edit transport schedules']);
        Permission::create(['name' => 'edit carpool schedules']);

        /* Create roles and assign permissions */

        // Admin
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('view transport schedules');
        $admin->givePermissionTo('edit transport request');
        $admin->givePermissionTo('edit carpool request');
        $admin->givePermissionTo('edit user');
        $admin->givePermissionTo('edit carpool vehicles');
        $admin->givePermissionTo('edit school vehicles');
        $admin->givePermissionTo('edit school drivers');
        $admin->givePermissionTo('edit transport schedules');
        $admin->givePermissionTo('edit carpool schedules');

        // Student
        $student = Role::create(['name' => 'student']);
        $student->givePermissionTo('edit transport request');
        $student->givePermissionTo('edit carpool request');
        $student->givePermissionTo('view transport schedules');
        $student->givePermissionTo('view carpool schedules');

        // Staff
        $staff = Role::create(['name' => 'staff']);
        $student->givePermissionTo('view transport schedules');
        $student->givePermissionTo('view carpool schedules');
        $staff->givePermissionTo('edit carpool request');

        // Carpool Driver
        $carpoolDriver = Role::create(['name' => 'carpool driver']);
        $carpoolDriver->givePermissionTo('edit carpool request');
        $carpoolDriver->givePermissionTo('edit carpool vehicles');


    }
}
