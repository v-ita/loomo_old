<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsArrayAdmin = [
            'create store', 'update store', 'update own store', 'delete store', 'delete own store',
            'create product', 'update product', 'update own product', 'delete product', 'delete own product',
            'create variant', 'create own product variant', 'update variant', 'update own product variant', 'delete variant', 'delete own product variant',
            'create category', 'update category', 'delete category',
            'create currency', 'update currency', 'delete currency',
            'create role', 'update role', 'delete role',
            'create role user', 'delete role user',
            'update cart', 'update own cart',
            'create permission role', 'update permission role', 'delete permission role',
            'update permission', 'delete permission',
            'create attribute', 'update attribute', 'delete attribute',
            'create attribute value', 'update attribute value', 'update own attribute value', 'delete attribute value', 'delete own attribute value',
            'create discount', 'update discount', 'update own discount', 'delete discount', 'delete own discount',
            'update user', 'delete user'
        ];
        $adminRole = Role::where('name', 'Administrator')->first();
        if ($adminRole) {
            $this->permissionAssignment($permissionsArrayAdmin, $adminRole);
        }

        $permissionsArraySystem = [
            'create category',
            'create currency',
            'create role',
            'create permission role',
            'update permission',
            'create attribute',
            'create attribute value',
        ];
        $adminSystem = Role::where('name', 'System')->first();
        if ($adminSystem) {
            $this->permissionAssignment($permissionsArraySystem, $adminSystem);
        }

        $permissionsArraySeller = [
            'create store', 'update own store', 'delete own store',
            'create product', 'update own product', 'delete own product',
            'create own product variant', 'update own product variant', 'delete own product variant',
            'update own cart',
            'create discount', 'update own discount', 'delete own discount',
        ];
        $adminSeller = Role::where('name', 'Seller')->first();
        if ($adminSeller) {
            $this->permissionAssignment($permissionsArraySeller, $adminSeller);
        }

        $permissionsArrayClient = [
            'update own cart'
        ];
        $adminClient = Role::where('name', 'Client')->first();
        if ($adminClient) {
            $this->permissionAssignment($permissionsArrayClient, $adminClient);
        }
    }

    private function permissionAssignment($permissions, Role $role)
    {
        $systemUser = User::where('email', 'system@system.system')->first();

        foreach ($permissions as $name) {
            $permission = Permission::where('code', Str::slug($name))->first();
            if ($permission) {
                $permissionRole = new PermissionRole();

                if ($systemUser) {
                    $permissionRole->createdBy()->associate($systemUser);
                }

                $permissionRole->permission()->associate($permission);
                $permissionRole->role()->associate($role);

                $permissionRole->save();
            }
        }
    }
}
