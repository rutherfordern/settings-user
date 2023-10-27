<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nickname' => 'admin',
            'email' => 'admin@admin.ru',
            'password' => Hash::make('admin'),
            'verification_method' => 'email',
        ]);
    }
}
