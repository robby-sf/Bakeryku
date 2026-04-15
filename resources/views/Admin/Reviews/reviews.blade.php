{{-- resources/views/Admin/Reviews/reviews.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Kelola Ulasan | Ananda Bakery')

@section('header_title', 'Review Moderation')
@section('header_subtitle', 'Kelola dan moderasi ulasan pelanggan sebelum ditampilkan.')

@section('header_actions')
    <div class="text-right">
        <span class="block font-heading text-3xl font-bold text-[#855333]">32</span>
        <span class="text-xs text-gray-500 font-medium">Total Ulasan</span>
    </div>
@endsection

@section('content')

    <div class="flex items-center gap-3 mb-6 overflow-x-auto hide-scroll-bar pb-2">
        <button class="flex items-center gap-2 px-4 py-2 bg-[#855333] text-white rounded-lg text-sm font-bold shadow-sm transition">
            Semua Ulasan <span class="bg-white/20 px-2 py-0.5 rounded-full text-[10px]">32</span>
        </button>
        <button class="flex items-center gap-2 px-4 py-2 bg-[#EAE2D6] text-[#452A1B] hover:bg-[#DCD0C0] rounded-lg text-sm font-medium transition">
            Diterbitkan <span class="bg-[#452A1B]/10 px-2 py-0.5 rounded-full text-[10px]">28</span>
        </button>
        <button class="flex items-center gap-2 px-4 py-2 bg-[#EAE2D6] text-[#452A1B] hover:bg-[#DCD0C0] rounded-lg text-sm font-medium transition">
            Disembunyikan <span class="bg-[#452A1B]/10 px-2 py-0.5 rounded-full text-[10px]">3</span>
        </button>
        <button class="flex items-center gap-2 px-4 py-2 bg-[#EAE2D6] text-[#452A1B] hover:bg-[#DCD0C0] rounded-lg text-sm font-medium transition">
            Spam <span class="bg-[#452A1B]/10 px-2 py-0.5 rounded-full text-[10px]">1</span>
        </button>
    </div>

    <div class="space-y-4">
        
        <div class="bg-white rounded-xl p-5 md:p-6 shadow-sm border border-[#EAE2D6] flex flex-col md:flex-row gap-5">
            <div class="hidden md:flex w-12 h-12 rounded-full bg-[#FAF8F5] text-[#855333] items-center justify-center font-bold text-lg border border-[#EAE2D6] flex-shrink-0">
                A
            </div>
            
            <div class="flex-grow">
                <div class="flex justify-between items-start mb-1">
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h3 class="font-bold text-[#452A1B] text-base">Alice Johnson</h3>
                            <div class="flex text-yellow-400 text-[10px]">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">Produk: <span class="font-bold text-[#452A1B]">Classic Croissant</span></p>
                    </div>
                    <span class="text-xs text-gray-400">20 Mar 2024</span>
                </div>

                <div class="mt-4 p-4 rounded-lg bg-[#FAF8F5] border border-[#EAE2D6]/50">
                    <p class="text-sm text-gray-700 italic">"The best croissant I have ever had! So flaky and buttery. Will definitely order again."</p>
                </div>

                <div class="flex justify-end gap-3 mt-4 md:hidden border-t border-[#EAE2D6] pt-4">
                    <button class="text-[#855333] hover:bg-[#EAE2D6] px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5">
                        <i class="fa-regular fa-eye-slash"></i> Sembunyikan
                    </button>
                    <button class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5">
                        <i class="fa-regular fa-trash-can"></i> Hapus
                    </button>
                </div>
            </div>

            <div class="hidden md:flex flex-col gap-2 items-end justify-center pl-4 border-l border-[#EAE2D6]">
                <button class="text-gray-400 hover:text-[#855333] hover:bg-[#EAE2D6] w-10 h-10 rounded-lg flex items-center justify-center transition" title="Sembunyikan Ulasan">
                    <i class="fa-regular fa-eye-slash text-lg"></i>
                </button>
                <button class="text-gray-400 hover:text-red-500 hover:bg-red-50 w-10 h-10 rounded-lg flex items-center justify-center transition" title="Hapus Ulasan">
                    <i class="fa-regular fa-trash-can text-lg"></i>
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 md:p-6 shadow-sm border border-[#EAE2D6] flex flex-col md:flex-row gap-5">
            <div class="hidden md:flex w-12 h-12 rounded-full bg-[#FAF8F5] text-[#855333] items-center justify-center font-bold text-lg border border-[#EAE2D6] flex-shrink-0">
                B
            </div>
            <div class="flex-grow">
                <div class="flex justify-between items-start mb-1">
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h3 class="font-bold text-[#452A1B] text-base">Bob Smith</h3>
                            <div class="flex text-yellow-400 text-[10px]">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star text-gray-300"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">Produk: <span class="font-bold text-[#452A1B]">Chocolate Lava Bun</span></p>
                    </div>
                    <span class="text-xs text-gray-400">18 Mar 2024</span>
                </div>
                <div class="mt-4 p-4 rounded-lg bg-[#FAF8F5] border border-[#EAE2D6]/50">
                    <p class="text-sm text-gray-700 italic">"Delicious chocolate filling, but a bit too sweet for me. Great texture though!"</p>
                </div>
                <div class="flex justify-end gap-3 mt-4 md:hidden border-t border-[#EAE2D6] pt-4">
                    <button class="text-[#855333] hover:bg-[#EAE2D6] px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5">
                        <i class="fa-regular fa-eye-slash"></i> Sembunyikan
                    </button>
                    <button class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5">
                        <i class="fa-regular fa-trash-can"></i> Hapus
                    </button>
                </div>
            </div>
            <div class="hidden md:flex flex-col gap-2 items-end justify-center pl-4 border-l border-[#EAE2D6]">
                <button class="text-gray-400 hover:text-[#855333] hover:bg-[#EAE2D6] w-10 h-10 rounded-lg flex items-center justify-center transition" title="Sembunyikan Ulasan">
                    <i class="fa-regular fa-eye-slash text-lg"></i>
                </button>
                <button class="text-gray-400 hover:text-red-500 hover:bg-red-50 w-10 h-10 rounded-lg flex items-center justify-center transition" title="Hapus Ulasan">
                    <i class="fa-regular fa-trash-can text-lg"></i>
                </button>
            </div>
        </div>

        <div class="bg-[#FAF8F5] rounded-xl p-5 md:p-6 shadow-inner border border-[#EAE2D6] flex flex-col md:flex-row gap-5 opacity-75">
            <div class="hidden md:flex w-12 h-12 rounded-full bg-white text-gray-400 items-center justify-center font-bold text-lg border border-gray-200 flex-shrink-0">
                C
            </div>
            <div class="flex-grow">
                <div class="flex justify-between items-start mb-1">
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h3 class="font-bold text-gray-500 text-base">Charlie Brown <span class="bg-gray-200 text-gray-600 text-[10px] px-2 py-0.5 rounded-full ml-2 font-normal">Disembunyikan</span></h3>
                            <div class="flex text-yellow-400 text-[10px] opacity-70">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400">Produk: <span class="font-bold text-gray-500">Smoked Beef & Cheese</span></p>
                    </div>
                    <span class="text-xs text-gray-400">15 Mar 2024</span>
                </div>
                <div class="mt-4 p-4 rounded-lg bg-white border border-[#EAE2D6]">
                    <p class="text-sm text-gray-500 italic">"Perfect breakfast with coffee."</p>
                </div>
                <div class="flex justify-end gap-3 mt-4 md:hidden border-t border-[#EAE2D6] pt-4">
                    <button class="text-green-600 hover:bg-green-50 px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5">
                        <i class="fa-regular fa-eye"></i> Tampilkan
                    </button>
                    <button class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5">
                        <i class="fa-regular fa-trash-can"></i> Hapus
                    </button>
                </div>
            </div>
            <div class="hidden md:flex flex-col gap-2 items-end justify-center pl-4 border-l border-[#EAE2D6]">
                <button class="text-green-500 hover:bg-green-50 w-10 h-10 rounded-lg flex items-center justify-center transition shadow-sm bg-white" title="Tampilkan Ulasan">
                    <i class="fa-regular fa-eye text-lg"></i>
                </button>
                <button class="text-gray-400 hover:text-red-500 hover:bg-red-50 w-10 h-10 rounded-lg flex items-center justify-center transition" title="Hapus Ulasan">
                    <i class="fa-regular fa-trash-can text-lg"></i>
                </button>
            </div>
        </div>

    </div>

    <div class="mt-8 flex justify-center">
        <div class="flex items-center bg-[#FAF8F5] rounded-lg border border-[#EAE2D6] p-1 shadow-sm">
            <button class="w-8 h-8 flex items-center justify-center text-gray-300 cursor-not-allowed" disabled>
                <i class="fa-solid fa-chevron-left text-xs"></i>
            </button>
            <span class="px-4 text-sm font-bold text-[#452A1B]">
                1 <span class="text-gray-400 font-normal mx-1">dari</span> 4
            </span>
            <button class="w-8 h-8 flex items-center justify-center text-[#452A1B] hover:bg-[#EAE2D6] rounded-md transition-colors">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>

@endsection