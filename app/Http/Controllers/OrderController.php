<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->guard('user')->user()->orders()->with('product')->latest()->paginate(12);
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $user = auth()->guard('user')->user();
        $product = Product::findOrFail($validated['product_id']);

        $quantity = $validated['quantity'];
        $totalPrice = $product->price * $quantity;
        $settings = Cache::get('app_settings', []);
        $waNumber = $settings['wa_number'] ?? '+6285602385989';
        $cleanNumber = preg_replace('/[^0-9]/', '', $waNumber);
        if (str_starts_with($cleanNumber, '0')) {
            $cleanNumber = '62'.ltrim($cleanNumber, '0');
        }

        $message = "Halo, saya ingin memesan produk dari Ananda Bakery:%0A";
        $message .= "- Produk: {$product->name}%0A";
        $message .= "- Jumlah: {$quantity}%0A";
        $message .= "- Total: Rp " . number_format($totalPrice, 0, ',', '.') . "%0A";
        $message .= "%0ASilakan bantu konfirmasi ketersediaan dan cara pembayaran. Terima kasih.";

        $order = $user->orders()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'message' => "Pesanan WhatsApp untuk {$product->name}",
            'whatsapp_number' => $cleanNumber,
            'whatsapp_message' => rawurldecode($message),
            'status' => 'pending',
        ]);

        \App\Models\ActivityLog::log('order', 'Pesanan WhatsApp dibuat', "Pengguna {$user->name} memesan {$product->name} sebanyak {$quantity} pcs dengan total Rp " . number_format($totalPrice, 0, ',', '.') . ".", $user->id);

        $whatsappUrl = 'https://wa.me/' . $cleanNumber . '?text=' . $message;

        return redirect()->away($whatsappUrl);
    }
}
