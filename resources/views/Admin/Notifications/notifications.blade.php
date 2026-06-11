{{-- resources/views/Admin/Notifications/index.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Notifikasi | Ananda Bakery')

@section('header_title', 'Notifikasi')
@section('header_subtitle', 'Pantau semua aktivitas toko, dan pemberitahuan sistem.')

@section('header_actions')
    @if($unreadCount > 0)
        <form method="POST" action="{{ route('admin.notifications.mark-all-read') }}">
            @csrf
            <button type="submit" class="bg-white border border-[#EAE2D6] text-[#855333] hover:bg-[#FAF8F5] px-4 py-2.5 rounded-lg text-sm font-bold transition shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-check-double"></i>
                <span class="hidden sm:inline">Tandai Semua Dibaca</span>
            </button>
        </form>
    @endif
@endsection

@section('content')

    <div class="flex items-center gap-3 mb-6 overflow-x-auto hide-scroll-bar pb-2">
        <button class="flex items-center gap-2 px-5 py-2.5 bg-[#855333] text-white rounded-lg text-sm font-bold shadow-sm transition">
            Semua <span class="bg-white/20 px-2 py-0.5 rounded-full text-[10px]">{{ $totalCount }}</span>
        </button>
        <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5] rounded-lg text-sm font-medium transition shadow-sm">
            Belum Dibaca
            @if($unreadCount > 0)
                <span class="bg-[#DE5B6D] text-white px-2 py-0.5 rounded-full text-[10px]">{{ $unreadCount }}</span>
            @endif
        </button>
        <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5] rounded-lg text-sm font-medium transition shadow-sm">
            Pesanan
        </button>
        <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5] rounded-lg text-sm font-medium transition shadow-sm">
            Sistem
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-[#EAE2D6] overflow-hidden">
        <div class="divide-y divide-[#EAE2D6]">
            @forelse($notifications as $notification)
                @php
                    $icon = 'fa-bell';
                    $iconBg = 'bg-blue-50 text-blue-500 border-blue-100';
                    $indicator = 'bg-[#DE5B6D]';
                    $buttonColor = 'text-blue-600 hover:text-blue-800';

                    if ($notification->type === 'review' || str_starts_with($notification->type, 'review_')) {
                        $icon = 'fa-star';
                        $iconBg = 'bg-yellow-50 text-yellow-500 border-yellow-100';
                    } elseif ($notification->type === 'admin_response') {
                        $icon = 'fa-reply';
                        $iconBg = 'bg-blue-50 text-blue-500 border-blue-100';
                    } elseif ($notification->type === 'system') {
                        $icon = 'fa-gear';
                        $iconBg = 'bg-gray-100 text-gray-500 border-gray-200';
                        $indicator = 'bg-gray-300';
                        $buttonColor = 'text-gray-600 hover:text-gray-800';
                    } elseif ($notification->type === 'user_registered') {
                        $icon = 'fa-user-plus';
                        $iconBg = 'bg-emerald-50 text-emerald-500 border-emerald-100';
                        $buttonColor = 'text-emerald-600 hover:text-emerald-800';
                    }
                @endphp

                <div class="p-5 flex gap-4 items-start {{ $notification->is_read ? 'bg-white' : 'bg-[#FAF8F5]' }} hover:bg-[#EAE2D6]/40 transition cursor-pointer group relative">
                    @if(!$notification->is_read)
                        <div class="absolute top-1/2 -translate-y-1/2 left-3 w-2 h-2 rounded-full {{ $indicator }}"></div>
                    @endif
                    <div class="w-12 h-12 rounded-full {{ $iconBg }} flex flex-shrink-0 items-center justify-center text-lg border ml-3">
                        <i class="fa-solid {{ $icon }}"></i>
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between items-start mb-1">
                            <h4 class="text-sm font-bold text-[#452A1B] group-hover:text-[#855333] transition">{{ $notification->title }}</h4>
                            <span class="text-xs font-bold text-[#855333]">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">{{ $notification->message }}</p>
                        @if($notification->link)
                            <a href="{{ $notification->link }}" class="text-xs font-bold {{ $buttonColor }} transition">Lihat Detail &rarr;</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="px-6 py-10 text-center text-gray-500">
                    Tidak ada notifikasi untuk ditampilkan.
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-8 flex justify-center">
        <div class="flex items-center bg-white rounded-lg border border-[#EAE2D6] p-1 shadow-sm">
            <button class="w-8 h-8 flex items-center justify-center text-gray-300 cursor-not-allowed" disabled>
                <i class="fa-solid fa-chevron-left text-xs"></i>
            </button>
            <span class="px-4 text-sm font-bold text-[#452A1B]">
                1 <span class="text-gray-400 font-normal mx-1">dari</span> {{ $notifications->lastPage() ?? 1 }}
            </span>
            <button class="w-8 h-8 flex items-center justify-center text-[#452A1B] hover:bg-[#FAF8F5] rounded-md transition-colors">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>

@endsection
