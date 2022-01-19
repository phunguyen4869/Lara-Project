<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //create permissions
        Permission::create(['name' => 'show slider']);
        Permission::create(['name' => 'create slider']);
        Permission::create(['name' => 'edit slider']);
        Permission::create(['name' => 'delete slider']);

        Permission::create(['name' => 'show category']);
        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);

        Permission::create(['name' => 'show product']);
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);

        Permission::create(['name' => 'show user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'moderator']);
        $role->givePermissionTo([
            'show product',
            'create product',
            'edit product',
            'delete product',
            'show slider',
            'create slider',
            'edit slider',
            'delete slider',
            'show user',
            'create user',
            'edit user',
        ]);

        $role = Role::create(['name' => 'editor']);
        $role->givePermissionTo([
            'show slider',
            'create slider',
            'edit slider',
            'show product',
            'create product',
            'edit product',
        ]);

        $role = Role::create(['name' => 'member']);

        $user = \App\Models\User::first();
        $user->assignRole('admin');
    }
}
