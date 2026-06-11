<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            PromoSeeder::class,
            ReviewSeeder::class,
            FavoriteSeeder::class,
            OrderSeeder::class,
            NotificationSeeder::class,
            PageVisitSeeder::class,
            ActivityLogSeeder::class,
        ]);
    }
}
