{{-- resources/views/Admin/Notifications/index.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Notifikasi | Ananda Bakery')

@section('header_title', 'Notifikasi')
@section('header_subtitle', 'Pantau semua aktivitas toko, pesanan baru, dan pemberitahuan sistem.')

@section('header_actions')
    <button class="bg-white border border-[#EAE2D6] text-[#855333] hover:bg-[#FAF8F5] px-4 py-2.5 rounded-lg text-sm font-bold transition shadow-sm flex items-center gap-2">
        <i class="fa-solid fa-check-double"></i>
        <span class="hidden sm:inline">Tandai Semua Dibaca</span>
    </button>
@endsection

@section('content')

    <div class="flex items-center gap-3 mb-6 overflow-x-auto hide-scroll-bar pb-2">
        <button class="flex items-center gap-2 px-5 py-2.5 bg-[#855333] text-white rounded-lg text-sm font-bold shadow-sm transition">
            Semua <span class="bg-white/20 px-2 py-0.5 rounded-full text-[10px]">12</span>
        </button>
        <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5] rounded-lg text-sm font-medium transition shadow-sm">
            Belum Dibaca <span class="bg-[#DE5B6D] text-white px-2 py-0.5 rounded-full text-[10px]">3</span>
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
            
            <div class="p-5 flex gap-4 items-start bg-[#FAF8F5] hover:bg-[#EAE2D6]/40 transition cursor-pointer group relative">
                <div class="absolute top-1/2 -translate-y-1/2 left-3 w-2 h-2 rounded-full bg-[#DE5B6D]"></div>
                
                <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-500 flex flex-shrink-0 items-center justify-center text-lg border border-blue-100 ml-3">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex justify-between items-start mb-1">
                        <h4 class="text-sm font-bold text-[#452A1B] group-hover:text-[#855333] transition">Pesanan Baru: #INV-4521</h4>
                        <span class="text-xs font-bold text-[#855333]">2 mnt lalu</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">Pelanggan Siti Nurhaliza telah menyelesaikan pembayaran untuk pesanan Dubai Series Cake. Segera siapkan pesanan!</p>
                    <button class="text-xs font-bold text-blue-600 hover:text-blue-800 transition">Lihat Detail Pesanan &rarr;</button>
                </div>
            </div>

            <div class="p-5 flex gap-4 items-start bg-[#FAF8F5] hover:bg-[#EAE2D6]/40 transition cursor-pointer group relative">
                <div class="absolute top-1/2 -translate-y-1/2 left-3 w-2 h-2 rounded-full bg-[#DE5B6D]"></div>
                
                <div class="w-12 h-12 rounded-full bg-yellow-50 text-yellow-500 flex flex-shrink-0 items-center justify-center text-lg border border-yellow-100 ml-3">
                    <i class="fa-solid fa-star"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex justify-between items-start mb-1">
                        <h4 class="text-sm font-bold text-[#452A1B] group-hover:text-[#855333] transition">Ulasan Bintang 5 Baru</h4>
                        <span class="text-xs font-bold text-[#855333]">1 jam lalu</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">"The best croissant I have ever had!" dari pengguna Alice Johnson pada produk Classic Croissant.</p>
                    <button class="text-xs font-bold text-yellow-600 hover:text-yellow-800 transition">Moderasi Ulasan &rarr;</button>
                </div>
            </div>

            <div class="p-5 flex gap-4 items-start bg-[#FAF8F5] hover:bg-[#EAE2D6]/40 transition cursor-pointer group relative">
                <div class="absolute top-1/2 -translate-y-1/2 left-3 w-2 h-2 rounded-full bg-[#DE5B6D]"></div>
                
                <div class="w-12 h-12 rounded-full bg-red-50 text-red-500 flex flex-shrink-0 items-center justify-center text-lg border border-red-100 ml-3">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex justify-between items-start mb-1">
                        <h4 class="text-sm font-bold text-[#452A1B] group-hover:text-[#855333] transition">Peringatan: Stok Hampir Habis</h4>
                        <span class="text-xs font-bold text-[#855333]">3 jam lalu</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">Stok untuk produk <span class="font-bold">Almond Danish</span> tersisa kurang dari 5 item. Segera perbarui ketersediaan di halaman produk.</p>
                    <button class="text-xs font-bold text-red-600 hover:text-red-800 transition">Update Stok &rarr;</button>
                </div>
            </div>

            <div class="p-5 flex gap-4 items-start bg-white hover:bg-[#FAF8F5] transition cursor-pointer group relative">
                <div class="ml-3 w-12 h-12 rounded-full bg-gray-100 text-gray-500 flex flex-shrink-0 items-center justify-center text-lg border border-gray-200">
                    <i class="fa-solid fa-gear"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex justify-between items-start mb-1">
                        <h4 class="text-sm font-medium text-gray-700 group-hover:text-[#855333] transition">Pembaruan Pengaturan Sistem</h4>
                        <span class="text-xs text-gray-400">Kemarin, 14:30</span>
                    </div>
                    <p class="text-sm text-gray-500">Nomor WhatsApp Business untuk toko berhasil diubah menjadi +62 812 1314 1500 oleh Store Manager.</p>
                </div>
            </div>

            <div class="p-5 flex gap-4 items-start bg-white hover:bg-[#FAF8F5] transition cursor-pointer group relative">
                <div class="ml-3 w-12 h-12 rounded-full bg-emerald-50 text-emerald-500 flex flex-shrink-0 items-center justify-center text-lg border border-emerald-100">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex justify-between items-start mb-1">
                        <h4 class="text-sm font-medium text-gray-700 group-hover:text-[#855333] transition">Pendaftaran Pengguna Baru</h4>
                        <span class="text-xs text-gray-400">Kemarin, 09:15</span>
                    </div>
                    <p class="text-sm text-gray-500">Budi Santoso (budi.santoso@email.com) baru saja mendaftar sebagai pelanggan baru.</p>
                </div>
            </div>

        </div>

    </div>

    <div class="mt-8 flex justify-center">
        <div class="flex items-center bg-white rounded-lg border border-[#EAE2D6] p-1 shadow-sm">
            <button class="w-8 h-8 flex items-center justify-center text-gray-300 cursor-not-allowed" disabled>
                <i class="fa-solid fa-chevron-left text-xs"></i>
            </button>
            <span class="px-4 text-sm font-bold text-[#452A1B]">
                1 <span class="text-gray-400 font-normal mx-1">dari</span> 3
            </span>
            <button class="w-8 h-8 flex items-center justify-center text-[#452A1B] hover:bg-[#FAF8F5] rounded-md transition-colors">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>

@endsection