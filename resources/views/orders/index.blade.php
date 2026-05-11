@extends('layouts.app')

@section('title', 'Order History | Ananda Bakery')

@section('content')
    <div class="py-8 md:py-12">
        <div class="container mx-auto px-4 md:px-6 max-w-6xl">
            <div class="mb-8">
                <h1 class="font-heading text-3xl md:text-4xl font-bold text-brand-dark mb-2">Riwayat Pesanan</h1>
                <p class="text-gray-600">Lihat detail semua pesanan WhatsApp yang kamu kirim.</p>
            </div>

            @if($orders->count())
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                                <div>
                                    <h2 class="font-bold text-lg text-brand-dark">{{ $order->product->name }}</h2>
                                    <p class="text-sm text-gray-500">Jumlah: {{ $order->quantity }} • Total Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-500">Status: <span class="font-semibold">{{ ucfirst($order->status) }}</span></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                                    <a href="https://wa.me/{{ $order->whatsapp_number }}?text={{ urlencode($order->whatsapp_message) }}" target="_blank" class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold hover:bg-green-200 transition">Buka WhatsApp</a>
                                </div>
                            </div>
                            <div class="mt-4 text-sm text-gray-600">
                                <p>{{ $order->message }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-gray-300 p-12 text-center">
                    <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-4"></i>
                    <h2 class="text-xl font-bold text-brand-dark mb-2">Belum ada pesanan</h2>
                    <p class="text-gray-500 mb-6">Mulai memesan langsung dari katalog kami melalui WhatsApp.</p>
                    <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 bg-brand-primary text-white px-6 py-3 rounded-full hover:bg-brand-dark transition">
                        Jelajahi Menu <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
