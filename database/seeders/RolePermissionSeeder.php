<?php

namespace Database\Seeders;

use App\Models\User;
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
        $permissions = [
            'manage categories',
            'manage packages',
            'manage transactions',
            'manage package banks',
            'checkout package',
            'view orders',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $customerRole = Role::create([
            'name' => 'customer'
        ]);

        $customerPermissions = [
            'checkout package',
            'view orders'
        ];

        $customerRole->syncPermissions($customerPermissions);

        $superAdminRole = Role::create([
            'name' => 'super admin'
        ]);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@email.com',
            'phone_number' => '081999720909',
            'avatar' => 'https://ui-avatars.com/api/?name=Super+Admin',
            'password' => bcrypt('rahasia')
        ]);

        $user->assignRole($superAdminRole);
    }
}
