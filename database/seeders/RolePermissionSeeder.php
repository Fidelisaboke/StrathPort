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
        Permission::create(['name' => 'view student dashboard']);
        Permission::create(['name' => 'view staff dashboard']);
        Permission::create(['name' => 'view carpool driver dashboard']);
        Permission::create(['name' => 'view transport schedules']);
        Permission::create(['name' => 'view carpool schedules']);
        Permission::create(['name' => 'edit transport requests']);
        Permission::create(['name' => 'edit carpool requests']);
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
        $admin->givePermissionTo('edit transport requests');
        $admin->givePermissionTo('edit carpool requests');
        $admin->givePermissionTo('edit user');
        $admin->givePermissionTo('edit carpool vehicles');
        $admin->givePermissionTo('edit school vehicles');
        $admin->givePermissionTo('edit school drivers');
        $admin->givePermissionTo('edit transport schedules');
        $admin->givePermissionTo('edit carpool schedules');
        $admin->givePermissionTo('view student dashboard');
        $admin->givePermissionTo('view staff dashboard');
        $admin->givePermissionTo('view carpool driver dashboard');

        // Student
        $student = Role::create(['name' => 'student']);
        $student->givePermissionTo('view student dashboard');
        $student->givePermissionTo('edit transport requests');
        $student->givePermissionTo('edit carpool requests');
        $student->givePermissionTo('view transport schedules');
        $student->givePermissionTo('view carpool schedules');

        // Staff
        $staff = Role::create(['name' => 'staff']);
        $staff->givePermissionTo('view staff dashboard');
        $staff->givePermissionTo('view transport schedules');
        $staff->givePermissionTo('view carpool schedules');
        $staff->givePermissionTo('edit carpool requests');
        $staff->givePermissionTo('view staff dashboard');

        // Carpool Driver
        $carpoolDriver = Role::create(['name' => 'carpool_driver']);
        $carpoolDriver->givePermissionTo('view carpool driver dashboard');
        $carpoolDriver->givePermissionTo('view carpool schedules');
        $carpoolDriver->givePermissionTo('edit carpool requests');
        $carpoolDriver->givePermissionTo('edit carpool vehicles');


    }
}
