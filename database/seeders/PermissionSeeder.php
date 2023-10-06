<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsArray = [
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

        $systemUser = User::where('email', 'system@system.system')->first();

        foreach ($permissionsArray as $name) {
            $permission = new Permission([
                'name' => Str::ucfirst($name),
                'code' => Str::slug($name)
            ]);

            if ($systemUser) {
                $permission->createdBy()->associate($systemUser);
            }
            $permission->save();
        }
    }
}
