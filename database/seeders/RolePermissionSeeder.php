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
        $permissions = [
            'view student dashboard',
            'view staff dashboard',
            'view carpool driver dashboard',
            'view admin dashboard',
            'view transport schedules',
            'view carpool schedules',
            'edit transport requests',
            'edit carpool requests',
            'edit user',
            'edit carpool vehicles',
            'edit school vehicles',
            'edit school drivers',
            'edit transport schedules',
            'edit carpool schedules',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        /* Create roles and assign permissions */

        $rolePermissions = [
            'admin' => [
                'view admin dashboard',
                'view transport schedules',
                'edit transport requests',
                'edit carpool requests',
                'edit user',
                'edit carpool vehicles',
                'edit school vehicles',
                'edit school drivers',
                'edit transport schedules',
                'edit carpool schedules',
            ],
            'student' => [
                'view student dashboard',
                'edit transport requests',
                'edit carpool requests',
                'view transport schedules',
                'view carpool schedules',
            ],
            'staff' => [
                'view staff dashboard',
                'view transport schedules',
                'view carpool schedules',
                'edit carpool requests',
                'view staff dashboard',
            ],
            'carpool_driver' => [
                'view carpool driver dashboard',
                'view carpool schedules',
                'edit carpool requests',
                'edit carpool vehicles',
            ],
        ];

        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo($permissions);
        }


    }
}
