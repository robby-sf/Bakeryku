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
            ['nadia@example.com', 'Butter Croissant', 2, 'Tolong dikirim sore ini.', 'pending'],
            ['raka@example.com', 'Chocolate Danish', 3, 'Untuk acara kantor besok pagi.', 'processed'],
            ['sinta@example.com', 'Strawberry Shortcake', 1, 'Tambahkan lilin ulang tahun kecil.', 'completed'],
        ];

        foreach ($orders as [$email, $productName, $quantity, $message, $status]) {
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

            Order::updateOrCreate(
                $attributes,
                $values
            );
        }
    }
}
