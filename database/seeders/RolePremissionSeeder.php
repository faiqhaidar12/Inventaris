<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePremissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Izin untuk Dashboard
        Permission::create(['name' => 'view-dashboard']);

        // Izin untuk Pengguna
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'read-users']);
        Permission::create(['name' => 'update-users']);
        Permission::create(['name' => 'delete-users']);

        // Izin untuk Kategori
        Permission::create(['name' => 'create-categories']);
        Permission::create(['name' => 'read-categories']);
        Permission::create(['name' => 'update-categories']);
        Permission::create(['name' => 'delete-categories']);

        // Izin untuk Barang
        Permission::create(['name' => 'create-products']);
        Permission::create(['name' => 'read-products']);
        Permission::create(['name' => 'update-products']);
        Permission::create(['name' => 'delete-products']);

        // Izin untuk Gudang
        Permission::create(['name' => 'create-warehouses']);
        Permission::create(['name' => 'read-warehouses']);
        Permission::create(['name' => 'update-warehouses']);
        Permission::create(['name' => 'delete-warehouses']);

        // Izin untuk Laporan
        Permission::create(['name' => 'view-reports']);

        //Role
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'staff']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'cashier']);
        Role::create(['name' => 'supplier']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('view-dashboard');

        $roleAdmin->givePermissionTo('create-users');
        $roleAdmin->givePermissionTo('read-users');
        $roleAdmin->givePermissionTo('update-users');
        $roleAdmin->givePermissionTo('delete-users');

        $roleAdmin->givePermissionTo('create-categories');
        $roleAdmin->givePermissionTo('read-categories');
        $roleAdmin->givePermissionTo('update-categories');
        $roleAdmin->givePermissionTo('delete-categories');

        $roleAdmin->givePermissionTo('create-products');
        $roleAdmin->givePermissionTo('read-products');
        $roleAdmin->givePermissionTo('update-products');
        $roleAdmin->givePermissionTo('delete-products');

        $roleAdmin->givePermissionTo('create-warehouses');
        $roleAdmin->givePermissionTo('read-warehouses');
        $roleAdmin->givePermissionTo('update-warehouses');
        $roleAdmin->givePermissionTo('delete-warehouses');

        $roleAdmin->givePermissionTo('view-reports');


        $roleStaff = Role::findByName('staff');
        $roleStaff->givePermissionTo('view-dashboard');

        $roleStaff->givePermissionTo('read-users');

        $roleStaff->givePermissionTo('read-categories');

        $roleStaff->givePermissionTo('create-products');
        $roleStaff->givePermissionTo('read-products');
        $roleStaff->givePermissionTo('update-products');
        $roleStaff->givePermissionTo('delete-products');

        $roleStaff->givePermissionTo('read-warehouses');

        $roleStaff->givePermissionTo('view-reports');
    }
}
