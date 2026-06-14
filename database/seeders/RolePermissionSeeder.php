<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();

        // Permissions
        Permission::firstOrCreate([
            'name' => 'manage playstations'
        ]);

        Permission::firstOrCreate([
            'name' => 'manage bookings'
        ]);

        Permission::firstOrCreate([
            'name' => 'manage payments'
        ]);

        Permission::firstOrCreate([
            'name' => 'view reports'
        ]);

        // Roles
        $admin = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        $owner = Role::firstOrCreate([
            'name' => 'owner'
        ]);

        $pembeli = Role::firstOrCreate([
            'name' => 'pembeli'
        ]);

        // Assign permissions
        $admin->syncPermissions([
            'manage playstations',
            'manage bookings',
            'manage payments',
            'view reports',
        ]);

        $owner->syncPermissions([
            'manage playstations',
            'view reports',
        ]);

        $pembeli->syncPermissions([
            'manage bookings',
            'manage payments',
        ]);
    }
}