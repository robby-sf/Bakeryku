{{-- resources/views/Admin/Activity/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Riwayat Aktivitas | Ananda Bakery')

@section('header_title', 'Riwayat Aktivitas')
@section('header_subtitle', 'Pantau seluruh rekam jejak, perubahan sistem, dan aktivitas pengguna.')

@section('header_actions')
    <a href="{{ route('admin.activities.export', ['type' => $type]) }}" class="bg-white border border-[#EAE2D6] text-[#855333] hover:bg-[#FAF8F5] px-4 py-2.5 rounded-lg text-sm font-bold transition shadow-sm flex items-center gap-2">
        <i class="fa-solid fa-download"></i>
        <span class="hidden sm:inline">Ekspor Log (.csv)</span>
    </a>
@endsection

@section('content')

    <div class="flex items-center gap-3 mb-6 overflow-x-auto hide-scroll-bar pb-2">
        <a href="{{ route('admin.activities', ['type' => 'all']) }}" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-bold shadow-sm transition {{ $type === 'all' ? 'bg-[#855333] text-white font-bold' : 'bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5]' }}">
            Semua Aktivitas
        </a>
        <a href="{{ route('admin.activities', ['type' => 'order']) }}" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-bold shadow-sm transition {{ $type === 'order' ? 'bg-[#855333] text-white font-bold' : 'bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5]' }}">
            Pesanan
        </a>
        <a href="{{ route('admin.activities', ['type' => 'review']) }}" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-bold shadow-sm transition {{ $type === 'review' ? 'bg-[#855333] text-white font-bold' : 'bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5]' }}">
            Ulasan
        </a>
        <a href="{{ route('admin.activities', ['type' => 'product']) }}" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-bold shadow-sm transition {{ $type === 'product' ? 'bg-[#855333] text-white font-bold' : 'bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5]' }}">
            Katalog & Stok
        </a>
        <a href="{{ route('admin.activities', ['type' => 'system']) }}" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-bold shadow-sm transition {{ $type === 'system' ? 'bg-[#855333] text-white font-bold' : 'bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5]' }}">
            Sistem
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-[#EAE2D6] overflow-hidden">
        
        <div class="divide-y divide-[#EAE2D6]">
            
            @forelse($activities as $activity)
                @php
                    $config = match($activity->type) {
                        'order' => [
                            'bg' => 'bg-green-50 text-green-600 border-green-100',
                            'icon' => 'fa-solid fa-shopping-cart'
                        ],
                        'review' => [
                            'bg' => 'bg-yellow-50 text-yellow-500 border-yellow-100',
                            'icon' => 'fa-solid fa-star'
                        ],
                        'user_register' => [
                            'bg' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                            'icon' => 'fa-solid fa-user-plus'
                        ],
                        'user_login' => [
                            'bg' => 'bg-blue-50 text-blue-500 border-blue-100',
                            'icon' => 'fa-solid fa-arrow-right-to-bracket'
                        ],
                        'product' => [
                            'bg' => 'bg-purple-50 text-purple-500 border-purple-100',
                            'icon' => 'fa-solid fa-cookie-bite'
                        ],
                        default => [
                            'bg' => 'bg-gray-100 text-gray-600 border-gray-200',
                            'icon' => 'fa-solid fa-gear'
                        ]
                    };
                @endphp
                <div class="p-5 md:p-6 flex gap-4 lg:gap-6 items-start hover:bg-[#FAF8F5]/50 transition group">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full flex flex-shrink-0 items-center justify-center text-lg lg:text-xl border {{ $config['bg'] }}">
                        <i class="{{ $config['icon'] }}"></i>
                    </div>
                    <div class="flex-grow min-w-0">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-1">
                            <h4 class="text-sm font-bold text-[#452A1B] group-hover:text-[#855333] transition truncate">{{ $activity->title }}</h4>
                            <span class="text-xs text-gray-500 font-medium mt-1 md:mt-0 bg-[#FAF8F5] px-2.5 py-1 rounded-md border border-[#EAE2D6] whitespace-nowrap">{{ $activity->created_at->translatedFormat('d M Y, H:i') }} WIB</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">{{ $activity->description }}</p>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-gray-400">
                    <i class="fa-regular fa-folder-open text-4xl mb-4 block"></i>
                    <p class="text-lg font-bold text-[#452A1B] mb-1">Belum Ada Aktivitas</p>
                    <p class="text-sm text-gray-500">Aktivitas dari tipe filter ini belum tercatat.</p>
                </div>
            @endforelse

        </div>
    </div>

    @if ($activities->hasPages())
        <div class="mt-8 flex justify-center mb-10 admin-pagination">
            {{ $activities->links() }}
        </div>
    @endif

@endsection