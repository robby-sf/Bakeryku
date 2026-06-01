<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Bakeryku Admin',
                'email' => 'admin@bakeryku.test',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '+6281213141500',
                'address' => 'Jl. Bakeryku No. 1, Jakarta',
            ],
            [
                'name' => 'Nadia Putri',
                'email' => 'nadia@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'date_of_birth' => '2001-05-14',
                'phone' => '+6281234567801',
                'address' => 'Jl. Melati No. 12, Bandung',
            ],
            [
                'name' => 'Raka Pratama',
                'email' => 'raka@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'date_of_birth' => '1999-11-20',
                'phone' => '+6281234567802',
                'address' => 'Jl. Kenanga No. 8, Tangerang',
            ],
            [
                'name' => 'Sinta Lestari',
                'email' => 'sinta@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'date_of_birth' => '2003-02-07',
                'phone' => '+6281234567803',
                'address' => 'Jl. Mawar No. 5, Depok',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
