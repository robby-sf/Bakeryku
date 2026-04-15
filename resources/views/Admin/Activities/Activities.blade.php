{{-- resources/views/Admin/Activity/index.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Riwayat Aktivitas | Ananda Bakery')

@section('header_title', 'Riwayat Aktivitas')
@section('header_subtitle', 'Pantau seluruh rekam jejak, perubahan sistem, dan aktivitas pengguna.')

@section('header_actions')
    <button class="bg-white border border-[#EAE2D6] text-[#855333] hover:bg-[#FAF8F5] px-4 py-2.5 rounded-lg text-sm font-bold transition shadow-sm flex items-center gap-2">
        <i class="fa-solid fa-download"></i>
        <span class="hidden sm:inline">Ekspor Log (.csv)</span>
    </button>
@endsection

@section('content')

    <div class="flex items-center gap-3 mb-6 overflow-x-auto hide-scroll-bar pb-2">
        <button class="flex items-center gap-2 px-5 py-2.5 bg-[#855333] text-white rounded-lg text-sm font-bold shadow-sm transition">
            Semua Aktivitas
        </button>
        <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5] rounded-lg text-sm font-medium transition shadow-sm">
            Pesanan
        </button>
        <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5] rounded-lg text-sm font-medium transition shadow-sm">
            Ulasan
        </button>
        <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5] rounded-lg text-sm font-medium transition shadow-sm">
            Katalog & Stok
        </button>
        <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#EAE2D6] text-[#452A1B] hover:bg-[#FAF8F5] rounded-lg text-sm font-medium transition shadow-sm">
            Sistem
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-[#EAE2D6] overflow-hidden">
        
        <div class="divide-y divide-[#EAE2D6]">
            
            <div class="p-5 md:p-6 flex gap-4 lg:gap-6 items-start hover:bg-[#FAF8F5] transition group">
                <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-yellow-50 text-yellow-500 flex flex-shrink-0 items-center justify-center text-lg lg:text-xl border border-yellow-100">
                    <i class="fa-solid fa-star"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-1">
                        <h4 class="text-sm font-bold text-[#452A1B] group-hover:text-[#855333] transition">Ulasan baru pada produk Dubai Series Cake</h4>
                        <span class="text-xs text-gray-500 font-medium mt-1 md:mt-0 bg-[#FAF8F5] px-2 py-1 rounded-md border border-[#EAE2D6]">Hari ini, 10:23 WIB</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Pengguna <span class="font-bold text-[#452A1B]">Alice Johnson</span> memberikan ulasan bintang 5.</p>
                </div>
            </div>

            <div class="p-5 md:p-6 flex gap-4 lg:gap-6 items-start hover:bg-[#FAF8F5] transition group">
                <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-emerald-50 text-emerald-500 flex flex-shrink-0 items-center justify-center text-lg lg:text-xl border border-emerald-100">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-1">
                        <h4 class="text-sm font-bold text-[#452A1B] group-hover:text-[#855333] transition">Pengguna baru mendaftar</h4>
                        <span class="text-xs text-gray-500 font-medium mt-1 md:mt-0 bg-[#FAF8F5] px-2 py-1 rounded-md border border-[#EAE2D6]">Hari ini, 08:15 WIB</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Pengguna <span class="font-bold text-[#452A1B]">Budi Santoso</span> berhasil membuat akun baru.</p>
                </div>
            </div>

            <div class="p-5 md:p-6 flex gap-4 lg:gap-6 items-start hover:bg-[#FAF8F5] transition group">
                <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-blue-50 text-blue-500 flex flex-shrink-0 items-center justify-center text-lg lg:text-xl border border-blue-100">
                    <i class="fa-regular fa-image"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-1">
                        <h4 class="text-sm font-bold text-[#452A1B] group-hover:text-[#855333] transition">Katalog menu diperbarui</h4>
                        <span class="text-xs text-gray-500 font-medium mt-1 md:mt-0 bg-[#FAF8F5] px-2 py-1 rounded-md border border-[#EAE2D6]">Kemarin, 16:45 WIB</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Admin memperbarui foto dan deskripsi pada produk <span class="font-bold text-[#452A1B]">Mini Round Cake</span>.</p>
                </div>
            </div>

            <div class="p-5 md:p-6 flex gap-4 lg:gap-6 items-start hover:bg-[#FAF8F5] transition group">
                <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-red-50 text-red-500 flex flex-shrink-0 items-center justify-center text-lg lg:text-xl border border-red-100">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-1">
                        <h4 class="text-sm font-bold text-[#452A1B] group-hover:text-[#855333] transition">Ulasan ditandai sebagai spam</h4>
                        <span class="text-xs text-gray-500 font-medium mt-1 md:mt-0 bg-[#FAF8F5] px-2 py-1 rounded-md border border-[#EAE2D6]">06 Apr 2026, 14:20 WIB</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Sistem otomatis menyembunyikan ulasan dari pengguna tidak dikenal karena terdeteksi berisi tautan spam.</p>
                </div>
            </div>

            <div class="p-5 md:p-6 flex gap-4 lg:gap-6 items-start hover:bg-[#FAF8F5] transition group">
                <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-gray-100 text-gray-600 flex flex-shrink-0 items-center justify-center text-lg lg:text-xl border border-gray-200">
                    <i class="fa-solid fa-gear"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-1">
                        <h4 class="text-sm font-bold text-[#452A1B] group-hover:text-[#855333] transition">Pengaturan toko diubah</h4>
                        <span class="text-xs text-gray-500 font-medium mt-1 md:mt-0 bg-[#FAF8F5] px-2 py-1 rounded-md border border-[#EAE2D6]">05 Apr 2026, 09:00 WIB</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Admin (Store Manager) mengubah nomor WhatsApp penerima pesanan menjadi +62 812 1314 1500.</p>
                </div>
            </div>

            <div class="p-5 md:p-6 flex gap-4 lg:gap-6 items-start hover:bg-[#FAF8F5] transition group">
                <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-[#EAE2D6] text-[#855333] flex flex-shrink-0 items-center justify-center text-lg lg:text-xl border border-[#DCD0C0]">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="flex-grow">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-1">
                        <h4 class="text-sm font-bold text-[#452A1B] group-hover:text-[#855333] transition">Menu baru ditambahkan</h4>
                        <span class="text-xs text-gray-500 font-medium mt-1 md:mt-0 bg-[#FAF8F5] px-2 py-1 rounded-md border border-[#EAE2D6]">03 Apr 2026, 11:30 WIB</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Produk baru <span class="font-bold text-[#452A1B]">Almond Danish</span> berhasil ditambahkan ke kategori Pastry.</p>
                </div>
            </div>

        </div>
    </div>

    <div class="mt-8 flex justify-center mb-10">
        <div class="flex items-center bg-white rounded-lg border border-[#EAE2D6] p-1 shadow-sm">
            <button class="w-8 h-8 flex items-center justify-center text-gray-300 cursor-not-allowed" disabled>
                <i class="fa-solid fa-chevron-left text-xs"></i>
            </button>
            <span class="px-4 text-sm font-bold text-[#452A1B]">
                1 <span class="text-gray-400 font-normal mx-1">dari</span> 12
            </span>
            <button class="w-8 h-8 flex items-center justify-center text-[#452A1B] hover:bg-[#FAF8F5] rounded-md transition-colors">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>

@endsection