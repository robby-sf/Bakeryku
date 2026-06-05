<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            [
                'title' => 'Diskon Weekend 20%',
                'type' => 'discount_percent',
                'value' => 20,
                'start_date' => now()->subDays(3)->toDateString(),
                'end_date' => now()->addDays(10)->toDateString(),
                'description' => 'Nikmati diskon 20% untuk menu pilihan setiap akhir pekan.',
                'image' => null,
            ],
            [
                'title' => 'Buy 1 Get 1 Croissant',
                'type' => 'buy_1_get_1',
                'value' => null,
                'start_date' => now()->toDateString(),
                'end_date' => now()->addDays(7)->toDateString(),
                'description' => 'Beli satu croissant dan dapatkan satu croissant gratis.',
                'image' => null,
            ],
            [
                'title' => 'Paket Sarapan Hemat',
                'type' => 'bundle',
                'value' => 59000,
                'start_date' => now()->addDays(5)->toDateString(),
                'end_date' => now()->addDays(20)->toDateString(),
                'description' => 'Paket roti, pastry, dan minuman untuk menemani pagi.',
                'image' => null,
            ],
            [
                'title' => 'Potongan Rp 10.000',
                'type' => 'discount_nominal',
                'value' => 10000,
                'start_date' => now()->subDays(20)->toDateString(),
                'end_date' => now()->subDays(2)->toDateString(),
                'description' => 'Promo lama untuk menguji filter promo berakhir.',
                'image' => null,
            ],
        ];

        foreach ($promos as $promo) {
            Promo::updateOrCreate(
                ['title' => $promo['title']],
                $promo
            );
        }
    }
}
