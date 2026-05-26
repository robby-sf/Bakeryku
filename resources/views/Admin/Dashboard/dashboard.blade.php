{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard | Ananda Bakery')

@section('header_title', 'Dashboard')
@section('header_subtitle', 'Pantau performa katalog menu, kunjungan web, dan ulasan pelanggan.')

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6] flex justify-between items-start transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Total Menu</p>
                <h3 class="font-heading text-3xl font-bold text-[#452A1B]">{{ number_format($totalProducts) }}</h3>
                <p class="text-[10px] text-gray-400 mt-2 font-medium">+{{ number_format($productGrowth) }} bulan ini</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center text-xl shadow-sm border border-blue-100">
                <i class="fa-solid fa-box-open"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6] flex justify-between items-start transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Total Ulasan</p>
                <h3 class="font-heading text-3xl font-bold text-[#452A1B]">{{ number_format($totalReviews) }}</h3>
                <p class="text-[10px] text-gray-400 mt-2 font-medium">+{{ number_format($reviewGrowth) }} bulan ini</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl shadow-sm border border-emerald-100">
                <i class="fa-regular fa-comment-dots"></i>
            </div>
        </div>

        <div class="bg-[#FCFAFC] rounded-2xl p-6 shadow-sm border-2 border-[#855333]/20 flex justify-between items-start transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Rata-rata Rating</p>
                <h3 class="font-heading text-3xl font-bold text-[#452A1B]">{{ number_format($averageRating, 1) }}</h3>
                <p class="text-[10px] text-[#BA8E60] font-bold mt-2 flex items-center gap-1">
                    <i class="fa-solid fa-star"></i> {{ $ratingStatus }}
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-yellow-50 text-yellow-500 flex items-center justify-center text-xl shadow-sm border border-yellow-100">
                <i class="fa-regular fa-star"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6] flex justify-between items-start transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kunjungan Web</p>
                <h3 class="font-heading text-3xl font-bold text-[#452A1B]">{{ number_format($totalVisits) }}</h3>
                <p class="text-[10px] {{ $visitGrowth > 0 ? 'text-[#BA8E60]' : 'text-gray-400' }} font-medium mt-2">{{ $visitStatus }}</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center text-xl shadow-sm border border-orange-100">
                <i class="fa-solid fa-arrow-trend-up"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6]">
            <h2 class="font-heading text-lg font-bold text-[#452A1B] mb-6">Tren Interaksi Web</h2>

            @if ($interactionTrend->sum('total') > 0)
                <div class="space-y-6">
                    @foreach ($interactionTrend as $week)
                        <div>
                            <div class="flex justify-between text-sm font-medium text-[#452A1B] mb-2">
                                <span>{{ $week['label'] }}</span>
                                <span>{{ number_format($week['total']) }} interaksi</span>
                            </div>
                            <div class="w-full bg-[#EAE2D6] rounded-full h-2.5 overflow-hidden">
                                <div class="bg-[#855333] h-2.5 rounded-full" style="width: {{ max($week['percent'], 4) }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-xl bg-[#FAF8F5] border border-[#EAE2D6] p-6 text-center">
                    <p class="text-sm font-semibold text-[#452A1B]">Belum ada interaksi web yang tercatat.</p>
                    <p class="text-xs text-gray-500 mt-1">Data akan muncul setelah pelanggan membuka halaman, memberi ulasan, menyimpan favorit, atau membuat pesanan.</p>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6]">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-heading text-xl font-bold text-[#452A1B]">Menu Paling Populer</h2>
                <i class="fa-solid fa-arrow-trend-up text-[#BA8E60]"></i>
            </div>

            @if ($popularProducts->isNotEmpty())
                <div class="space-y-4">
                    @foreach ($popularProducts as $product)
                        <a href="{{ route('menu_view', $product->id) }}" class="flex items-center justify-between group">
                            <div class="flex items-center gap-4 min-w-0">
                                <div class="w-14 h-14 rounded-xl overflow-hidden shadow-sm flex-shrink-0 bg-[#EAE2D6] border border-gray-100">
                                    @if ($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <i class="fa-regular fa-image text-lg"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-base font-bold text-[#452A1B] mb-0.5 group-hover:text-[#BA8E60] transition-colors truncate">{{ $product->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $product->category ?: 'Tanpa kategori' }} &bull; {{ number_format($product->visit_count) }} kali dilihat</p>
                                </div>
                            </div>
                            <div class="text-right pl-4 flex-shrink-0">
                                <span class="block text-sm font-bold text-[#855333]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-[10px] text-yellow-500 font-bold flex items-center justify-end gap-1 mt-0.5">
                                    <i class="fa-solid fa-star"></i> {{ number_format($product->average_rating, 1) }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="rounded-xl bg-[#FAF8F5] border border-[#EAE2D6] p-6 text-center">
                    <p class="text-sm font-semibold text-[#452A1B]">Belum ada menu untuk ditampilkan.</p>
                    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 mt-3 text-sm font-bold text-[#855333] hover:text-[#452A1B]">
                        <i class="fa-solid fa-plus"></i> Tambah Menu
                    </a>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6]">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-heading text-lg font-bold text-[#452A1B]">Aktivitas Terbaru</h2>
            <a href="{{ route('admin.activities') }}" class="text-sm font-bold text-[#855333] hover:text-[#452A1B] hover:underline transition-colors">
                Lihat Semua
            </a>
        </div>

        @if ($recentActivities->isNotEmpty())
            <div class="space-y-3">
                @foreach ($recentActivities as $activity)
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-[#EAE2D6]/30">
                        <div class="mt-1.5 w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color: {{ $activity['color'] }}"></div>
                        <div class="min-w-0">
                            <h4 class="text-sm font-medium text-[#452A1B]">{{ $activity['title'] }}</h4>
                            <p class="text-xs text-gray-600 mt-1">{{ $activity['description'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $activity['date']->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-xl bg-[#FAF8F5] border border-[#EAE2D6] p-6 text-center">
                <p class="text-sm font-semibold text-[#452A1B]">Belum ada aktivitas terbaru.</p>
                <p class="text-xs text-gray-500 mt-1">Aktivitas dari ulasan, pelanggan, pesanan, dan pembaruan menu akan muncul di sini.</p>
            </div>
        @endif
    </div>

@endsection
