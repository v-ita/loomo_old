<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Taftadjani',
            'last_name' => 'Dahirou',
            'email' => 'taftadjani@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'first_name' => 'System',
            'last_name' => 'System',
            'email' => 'system@system.system',
            'password' => Hash::make('12345678')
        ]);
    }
}
