@extends('layouts.app')

@section('title', 'Favorites | Ananda Bakery')

@section('content')
    <div class="py-8 md:py-12">
        <div class="container mx-auto px-4 md:px-6 max-w-6xl">
            <div class="mb-8">
                <h1 class="font-heading text-3xl md:text-4xl font-bold text-brand-dark mb-2">Favorit Saya</h1>
                <p class="text-gray-600">Produk yang kamu simpan untuk dilihat lagi nanti.</p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if($favorites->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($favorites as $favorite)
                        <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group">
                            <a href="{{ route('menu_view', $favorite->product->id) }}" class="block h-full">
                                <div class="h-48 bg-gray-100 overflow-hidden">
                                    <img src="{{ $favorite->product->image ? Storage::url($favorite->product->image) : 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?q=80&w=600&auto=format&fit=crop' }}" alt="{{ $favorite->product->name }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                </div>
                                <div class="p-5">
                                    <h2 class="font-bold text-brand-dark mb-1">{{ $favorite->product->name }}</h2>
                                    <p class="text-sm text-gray-500 mb-4">Rp {{ number_format($favorite->product->price, 0, ',', '.') }}</p>
                                    <span class="inline-flex items-center gap-2 text-xs uppercase tracking-wider font-semibold text-green-700 bg-green-100 px-2 py-1 rounded-full">{{ $favorite->product->status }}</span>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $favorites->links() }}
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-gray-300 p-12 text-center">
                    <i class="fa-solid fa-heart text-4xl text-gray-300 mb-4"></i>
                    <h2 class="text-xl font-bold text-brand-dark mb-2">Belum ada favorit</h2>
                    <p class="text-gray-500 mb-6">Simpan produk favoritmu agar mudah ditemukan kembali nanti.</p>
                    <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 bg-brand-primary text-white px-6 py-3 rounded-full hover:bg-brand-dark transition">
                        Jelajahi Menu <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
