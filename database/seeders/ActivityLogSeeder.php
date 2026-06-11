<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users
        $admin = User::where('role', 'admin')->first();
        $nadia = User::where('email', 'nadia@example.com')->first();
        $raka = User::where('email', 'raka@example.com')->first();
        $sinta = User::where('email', 'sinta@example.com')->first();

        // Get some products
        $products = Product::take(5)->get();
        $product1 = $products->get(0)?->name ?? 'Donat Meses';

        $logs = [
            // === W3 Ago (May 18 - May 24) ===
            [
                'user_id' => $nadia?->id,
                'type' => 'user_register',
                'title' => 'Pengguna baru mendaftar',
                'description' => "Pengguna Nadia Putri berhasil membuat akun baru.",
                'created_at' => now()->subDays(20)->subHours(4),
            ],
            [
                'user_id' => $nadia?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Nadia Putri masuk ke akun.",
                'created_at' => now()->subDays(20)->subHours(3),
            ],
            [
                'user_id' => $nadia?->id,
                'type' => 'review',
                'title' => 'Ulasan baru pada produk ' . $product1,
                'description' => "Pengguna Nadia Putri memberikan ulasan bintang 5.",
                'created_at' => now()->subDays(20),
            ],
            [
                'user_id' => $raka?->id,
                'type' => 'user_register',
                'title' => 'Pengguna baru mendaftar',
                'description' => "Pengguna Raka Pratama berhasil membuat akun baru.",
                'created_at' => now()->subDays(18)->subHours(2),
            ],
            [
                'user_id' => $raka?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Raka Pratama masuk ke akun.",
                'created_at' => now()->subDays(18),
            ],
            [
                'user_id' => $sinta?->id,
                'type' => 'user_register',
                'title' => 'Pengguna baru mendaftar',
                'description' => "Pengguna Sinta Lestari berhasil membuat akun baru.",
                'created_at' => now()->subDays(17)->subHours(1),
            ],
            [
                'user_id' => $sinta?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Sinta Lestari masuk ke akun.",
                'created_at' => now()->subDays(17),
            ],

            // === W2 Ago (May 25 - May 31) ===
            [
                'user_id' => $nadia?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Nadia Putri masuk ke akun.",
                'created_at' => now()->subDays(14),
            ],
            [
                'user_id' => $raka?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Raka Pratama masuk ke akun.",
                'created_at' => now()->subDays(12),
            ],
            [
                'user_id' => $sinta?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Sinta Lestari masuk ke akun.",
                'created_at' => now()->subDays(10),
            ],
            [
                'user_id' => $nadia?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Nadia Putri masuk ke akun.",
                'created_at' => now()->subDays(9),
            ],

            // === W1 Ago (Jun 1 - Jun 7) ===
            [
                'user_id' => $nadia?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Nadia Putri masuk ke akun.",
                'created_at' => now()->subDays(6),
            ],
            [
                'user_id' => $raka?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Raka Pratama masuk ke akun.",
                'created_at' => now()->subDays(5),
            ],
            [
                'user_id' => $sinta?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Sinta Lestari masuk ke akun.",
                'created_at' => now()->subDays(4),
            ],
            [
                'user_id' => $nadia?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Nadia Putri masuk ke akun.",
                'created_at' => now()->subDays(3),
            ],
            [
                'user_id' => $raka?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Raka Pratama masuk ke akun.",
                'created_at' => now()->subDays(2),
            ],
            [
                'user_id' => $sinta?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Sinta Lestari masuk ke akun.",
                'created_at' => now()->subDays(1),
            ],
            [
                'user_id' => $admin?->id,
                'type' => 'product',
                'title' => 'Menu baru ditambahkan',
                'description' => "Produk baru Almond Danish berhasil ditambahkan ke kategori Pastry.",
                'created_at' => now()->subDays(3)->subHours(2),
            ],
            [
                'user_id' => $admin?->id,
                'type' => 'system',
                'title' => 'Pengaturan toko diubah',
                'description' => "Admin mengubah pengaturan toko, termasuk nomor WhatsApp penerima pesanan menjadi +6285602385989.",
                'created_at' => now()->subDays(4),
            ],

            // === W0 Ago (Minggu Ini: Jun 8+) ===
            [
                'user_id' => $nadia?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Nadia Putri masuk ke akun.",
                'created_at' => now()->subMinutes(50),
            ],
            [
                'user_id' => $raka?->id,
                'type' => 'user_login',
                'title' => 'Pengguna masuk',
                'description' => "Pengguna Raka Pratama masuk ke akun.",
                'created_at' => now()->subMinutes(15),
            ],
        ];

        foreach ($logs as $log) {
            ActivityLog::create([
                'user_id' => $log['user_id'],
                'type' => $log['type'],
                'title' => $log['title'],
                'description' => $log['description'],
                'created_at' => $log['created_at'],
                'updated_at' => $log['created_at'],
            ]);
        }
    }
}
