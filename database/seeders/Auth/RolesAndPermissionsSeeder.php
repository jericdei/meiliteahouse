<?php

namespace Database\Seeders\Auth;

use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'user' => [
                'create', 'view', 'update', 'delete',
            ],
            'investor' => [
                'create', 'view', 'update', 'delete',
            ],
            'investment' => [
                'create', 'view', 'update', 'delete',
            ],
            'withdrawal' => [
                'create', 'view', 'update', 'delete',
            ],
        ];

        $allPermissions = [];
        $investorPermissions = [];

        foreach ($permissions as $entity => $actions) {
            foreach ($actions as $action) {
                $permission = "{$action}_{$entity}";

                Permission::create([
                    'name' => $permission,
                ]);

                $allPermissions[] = $permission;

                if (in_array($entity, ['investment', 'withdrawal'])) {
                    $investorPermissions[] = $permission;
                }
            }
        }

        Role::create([
            'name' => 'admin',
        ])->givePermissionTo($allPermissions);

        Role::create([
            'name' => 'investor',
        ])->givePermissionTo($investorPermissions);

        User::firstOrCreate([
            'first_name' => 'Jeric June',
            'middle_name' => 'Galano',
            'last_name' => 'Logan',
            'contact_no' => '09760763828',
            'email' => 'jeric@meiliteahouse.com',
            'password' => bcrypt('loganmlth'),
            'photo' => 'https://api.dicebear.com/6.x/avataaars/svg?seed=Jeric',
        ])->assignRole('admin');
    }
}
