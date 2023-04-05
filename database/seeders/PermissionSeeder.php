<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            //Customer
            ['name' => 'Create Customer', 'guard_name' => 'web', 'model' => 'Customer'],
            ['name' => 'View Customer', 'guard_name' => 'web', 'model' => 'Customer'],
            ['name' => 'Edit Customer', 'guard_name' => 'web', 'model' => 'Customer'],
            ['name' => 'Delete Customer', 'guard_name' => 'web', 'model' => 'Customer'],

            //Settings
            ['name' => 'Employee Dashboard', 'guard_name' => 'web', 'model' => 'Settings'],
            ['name' => 'Manager Dashboard', 'guard_name' => 'web', 'model' => 'Settings'],
            ['name' => 'Product Category', 'guard_name' => 'web', 'model' => 'Settings'],
            ['name' => 'Product', 'guard_name' => 'web', 'model' => 'Settings'],
            ['name' => 'Sales', 'guard_name' => 'web', 'model' => 'Settings'],
            ['name' => 'Role', 'guard_name' => 'web', 'model' => 'Settings'],
            ['name' => 'Employee', 'guard_name' => 'web', 'model' => 'Settings'],
        ];

        foreach ($permissions as $permission) {
            if (!Permission::whereName($permission['name'])->exists()) {
                Permission::create($permission);
            }
        }

        $dbPermission = Permission::all()->pluck('name');
        $collectionPermission = collect($permissions)->pluck('name');

        $differenceArray = array_diff($dbPermission->toArray(), $collectionPermission->toArray());
        Permission::whereIn('name', $differenceArray)->delete();

        $permissionsIds = Permission::all()->pluck('id');

        if (!Role::whereName('Admin')->exists()) {
            $role = Role::create(['name' => 'Admin']);
            $role->givePermissionTo($permissionsIds);

            $user = [
                "employee_code" => 'EMP001',
                "name" => 'Admin',
                "phone" => '1111111111',
                "email" => 'admin@gmail.com',
                "password" => Hash::make('admin@123'),
            ];

            $user = User::create($user);
            $user->assignRole($role->id);
        } else {
            $role = Role::whereName('Admin')->first();
            $role->syncPermissions($permissionsIds);
        }

        if (!Role::whereName('Employee')->exists()) {
            $employeePermissionsIds = Permission::whereIn('name',['Leave Apply', 'View Payslip'])->pluck('id');
            $role = Role::create(['name' => 'Employee']);
            $role->syncPermissions($employeePermissionsIds);
        }
    }
}
