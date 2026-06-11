<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $hasMessage = Schema::hasColumn('orders', 'message');
        $hasWhatsappNumber = Schema::hasColumn('orders', 'whatsapp_number');
        $hasWhatsappMessage = Schema::hasColumn('orders', 'whatsapp_message');
        $hasStatus = Schema::hasColumn('orders', 'status');

        $orders = [
            // Week 3 ago: May 18 - 24
            ['nadia@example.com', 'Roti Tawar', 2, 'Tolong dikirim sore ini.', 'completed', now()->subDays(19)],
            ['raka@example.com', 'Roti Abon', 3, 'Untuk acara kantor.', 'completed', now()->subDays(18)],
            ['sinta@example.com', 'Roti Pisang Keju', 1, '', 'completed', now()->subDays(16)],
            
            // Week 2 ago: May 25 - 31
            ['nadia@example.com', 'Roti Pisang Coklat', 4, 'Bawa tas belanja.', 'completed', now()->subDays(12)],
            ['raka@example.com', 'Roti Coklat Keju', 2, '', 'completed', now()->subDays(10)],
            ['sinta@example.com', 'Roti Tawar', 3, 'Tebal.', 'completed', now()->subDays(9)],
            
            // Week 1 ago: Jun 1 - 7
            ['nadia@example.com', 'Donat Meses', 5, 'Ulang tahun Roni.', 'completed', now()->subDays(6)],
            ['raka@example.com', 'Donat Keju', 2, '', 'completed', now()->subDays(5)],
            ['sinta@example.com', 'Roll Cake', 1, 'Krim ekstra.', 'completed', now()->subDays(4)],
            ['nadia@example.com', 'Roti Sosis', 6, 'Anak sekolah.', 'completed', now()->subDays(2)],
            
            // This week: Jun 8+
            ['raka@example.com', 'Roti Choco Boat', 3, '', 'completed', now()->subHours(4)],
            ['sinta@example.com', 'Roti Cheese Boat', 2, 'Hangat.', 'completed', now()->subHours(2)],
        ];

        foreach ($orders as [$email, $productName, $quantity, $message, $status, $orderedAt]) {
            $user = User::where('email', $email)->first();
            $product = Product::where('name', $productName)->first();

            if (! $user || ! $product) {
                continue;
            }

            $totalPrice = $product->price * $quantity;
            $whatsappMessage = "Halo Bakeryku, saya ingin pesan {$quantity} {$product->name}. {$message}";

            $attributes = [
                'user_id' => $user->id,
                'product_id' => $product->id,
            ];

            if ($hasMessage) {
                $attributes['message'] = $message;
            }

            $values = [
                'quantity' => $quantity,
                'total_price' => $totalPrice,
            ];

            if ($hasWhatsappNumber) {
                $values['whatsapp_number'] = $user->phone;
            }

            if ($hasWhatsappMessage) {
                $values['whatsapp_message'] = $whatsappMessage;
            }

            if ($hasStatus) {
                $values['status'] = $status;
            }

            $order = Order::updateOrCreate(
                $attributes,
                $values
            );

            $order->created_at = $orderedAt;
            $order->updated_at = $orderedAt;
            $order->save();
        }
    }
}
