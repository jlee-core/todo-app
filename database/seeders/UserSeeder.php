<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => '研修ユーザー',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'api_token' => Str::random(80),
        ]);
    }
}
