<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesArray = [
            'administrator', 'system', 'seller', 'client'
        ];

        foreach ($rolesArray as $name) {
            $role = new Role([
                'name' => Str::ucfirst($name)
            ]);

            $systemUser = User::where('email', 'system@system.system')->first();

            if ($systemUser) {
                $role->createdBy()->associate($systemUser);
            }
            $role->save();
        }
    }
}
