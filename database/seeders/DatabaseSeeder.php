<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Taftadjani',
            'last_name' => 'Dahirou',
            'email' => 'taftadjani@gmail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
