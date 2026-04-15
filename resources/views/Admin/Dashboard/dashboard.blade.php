{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard | Ananda Bakery')

@section('header_title', 'Dashboard')
@section('header_subtitle', 'Pantau performa katalog menu dan ulasan pelanggan.')

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6] flex justify-between items-start transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Total Menu</p>
                <h3 class="font-heading text-3xl font-bold text-[#452A1B]">24</h3>
                <p class="text-[10px] text-gray-400 mt-2 font-medium">+2 bulan ini</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center text-xl shadow-sm border border-blue-100">
                <i class="fa-solid fa-box-open"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6] flex justify-between items-start transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Total Ulasan</p>
                <h3 class="font-heading text-3xl font-bold text-[#452A1B]">1,234</h3>
                <p class="text-[10px] text-gray-400 mt-2 font-medium">+124 bulan ini</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl shadow-sm border border-emerald-100">
                <i class="fa-regular fa-comment-dots"></i>
            </div>
        </div>

        <div class="bg-[#FCFAFC] rounded-2xl p-6 shadow-sm border-2 border-[#855333]/20 flex justify-between items-start transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Rata-rata Rating</p>
                <h3 class="font-heading text-3xl font-bold text-[#452A1B]">4.8</h3>
                <p class="text-[10px] text-[#BA8E60] font-bold mt-2 flex items-center gap-1">
                    <i class="fa-solid fa-star"></i> Sangat Memuaskan
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-yellow-50 text-yellow-500 flex items-center justify-center text-xl shadow-sm border border-yellow-100">
                <i class="fa-regular fa-star"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6] flex justify-between items-start transition hover:shadow-md">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kunjungan Web</p>
                <h3 class="font-heading text-3xl font-bold text-[#452A1B]">8,402</h3>
                <p class="text-[10px] text-red-400 font-medium mt-2">Perlu ditingkatkan</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center text-xl shadow-sm border border-orange-100">
                <i class="fa-solid fa-arrow-trend-up"></i>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6]">
            <h2 class="font-heading text-lg font-bold text-[#452A1B] mb-6">Tren Interaksi Web</h2>
            
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between text-sm font-medium text-[#452A1B] mb-2">
                        <span>Minggu 1</span>
                        <span>60%</span>
                    </div>
                    <div class="w-full bg-[#EAE2D6] rounded-full h-2.5">
                        <div class="bg-[#855333] h-2.5 rounded-full" style="width: 60%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm font-medium text-[#452A1B] mb-2">
                        <span>Minggu 2</span>
                        <span>75%</span>
                    </div>
                    <div class="w-full bg-[#EAE2D6] rounded-full h-2.5">
                        <div class="bg-[#855333] h-2.5 rounded-full" style="width: 75%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm font-medium text-[#452A1B] mb-2">
                        <span>Minggu 3</span>
                        <span>70%</span>
                    </div>
                    <div class="w-full bg-[#EAE2D6] rounded-full h-2.5">
                        <div class="bg-[#855333] h-2.5 rounded-full opacity-80" style="width: 70%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm font-medium text-[#452A1B] mb-2">
                        <span>Minggu 4</span>
                        <span>85%</span>
                    </div>
                    <div class="w-full bg-[#EAE2D6] rounded-full h-2.5">
                        <div class="bg-[#855333] h-2.5 rounded-full" style="width: 85%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6]">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-heading text-xl font-bold text-[#452A1B]">Menu Paling Populer</h2>
                <button class="text-[#BA8E60] hover:text-[#452A1B] transition"><i class="fa-solid fa-arrow-trend-up"></i></button>
            </div>
            
            <div class="space-y-4"> <div class="flex items-center justify-between group cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-xl overflow-hidden shadow-sm flex-shrink-0 relative">
                            <img src="https://images.unsplash.com/photo-1549931319-a545dcf3bc73?q=80&w=2070&auto=format&fit=crop" alt="Classic Croissant" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-[#452A1B] mb-0.5 group-hover:text-[#BA8E60] transition-colors">Classic Croissant</h4>
                            <p class="text-xs text-gray-500">Pastry • 156 kali dilihat</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="block text-sm font-bold text-[#855333]">Rp 25.000</span>
                        <span class="text-[10px] text-yellow-500 font-bold flex items-center justify-end gap-1 mt-0.5"><i class="fa-solid fa-star"></i> 4.9</span>
                    </div>
                </div>

                <div class="flex items-center justify-between group cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-xl overflow-hidden shadow-sm flex-shrink-0 relative">
                            <img src="https://images.unsplash.com/photo-1608198093002-ad4e005484ec?q=80&w=2132&auto=format&fit=crop" alt="Chocolate Lava Bun" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-[#452A1B] mb-0.5 group-hover:text-[#BA8E60] transition-colors">Chocolate Lava Bun</h4>
                            <p class="text-xs text-gray-500">Roti Manis • 142 kali dilihat</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="block text-sm font-bold text-[#855333]">Rp 18.000</span>
                        <span class="text-[10px] text-yellow-500 font-bold flex items-center justify-end gap-1 mt-0.5"><i class="fa-solid fa-star"></i> 4.8</span>
                    </div>
                </div>

                <div class="flex items-center justify-between group cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-xl overflow-hidden shadow-sm flex-shrink-0 relative">
                            <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=2072&auto=format&fit=crop" alt="Smoked Beef & Cheese" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-[#452A1B] mb-0.5 group-hover:text-[#BA8E60] transition-colors">Smoked Beef & Cheese</h4>
                            <p class="text-xs text-gray-500">Roti Asin • 128 kali dilihat</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="block text-sm font-bold text-[#855333]">Rp 22.000</span>
                        <span class="text-[10px] text-yellow-500 font-bold flex items-center justify-end gap-1 mt-0.5"><i class="fa-solid fa-star"></i> 4.7</span>
                    </div>
                </div>

                <div class="flex items-center justify-between group cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-xl overflow-hidden shadow-sm flex-shrink-0 relative">
                            <img src="https://images.unsplash.com/photo-1576618148400-f54bed99fcfd?q=80&w=2080&auto=format&fit=crop" alt="Blueberry Bun" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-[#452A1B] mb-0.5 group-hover:text-[#BA8E60] transition-colors">Blueberry Cheese Bun</h4>
                            <p class="text-xs text-gray-500">Roti Manis • 95 kali dilihat</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="block text-sm font-bold text-[#855333]">Rp 20.000</span>
                        <span class="text-[10px] text-yellow-500 font-bold flex items-center justify-end gap-1 mt-0.5"><i class="fa-solid fa-star"></i> 4.9</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#EAE2D6]">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-heading text-lg font-bold text-[#452A1B]">Aktivitas Terbaru</h2>
            <a href="{{ route('admin.activities') }}" class="text-sm font-bold text-[#855333] hover:text-[#452A1B] hover:underline transition-colors">
                Lihat Semua
            </a>
        </div>
        
        <div class="space-y-3">
            
            <div class="flex items-start gap-4 p-4 rounded-xl bg-[#EAE2D6]/30">
                <div class="mt-1.5 w-2.5 h-2.5 rounded-full bg-[#855333]"></div>
                <div>
                    <h4 class="text-sm font-medium text-[#452A1B]">Ulasan baru pada <span class="font-bold">Dubai Series Cake</span></h4>
                    <p class="text-xs text-gray-500 mt-1">2 jam yang lalu</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 rounded-xl bg-[#EAE2D6]/30">
                <div class="mt-1.5 w-2.5 h-2.5 rounded-full bg-[#BA8E60]"></div>
                <div>
                    <h4 class="text-sm font-medium text-[#452A1B]">Pengguna <span class="font-bold">Budi Santoso</span> mendaftar akun baru</h4>
                    <p class="text-xs text-gray-500 mt-1">4 jam yang lalu</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 rounded-xl bg-[#EAE2D6]/30">
                <div class="mt-1.5 w-2.5 h-2.5 rounded-full bg-blue-500"></div>
                <div>
                    <h4 class="text-sm font-medium text-[#452A1B]">Katalog menu <span class="font-bold">Mini Round Cake</span> diperbarui (Foto baru)</h4>
                    <p class="text-xs text-gray-500 mt-1">1 hari yang lalu</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 rounded-xl bg-[#EAE2D6]/30">
                <div class="mt-1.5 w-2.5 h-2.5 rounded-full bg-red-500"></div>
                <div>
                    <h4 class="text-sm font-medium text-[#452A1B]">Ulasan ditandai sebagai spam oleh sistem</h4>
                    <p class="text-xs text-gray-500 mt-1">2 hari yang lalu</p>
                </div>
            </div>

        </div>

        <div class="mt-6 text-center border-t border-[#EAE2D6] pt-4">
            <a href="#" class="inline-block text-sm font-bold text-[#855333] hover:text-[#452A1B] transition-colors">
                Tampilkan Lebih Banyak <i class="fa-solid fa-chevron-down ml-1 text-xs"></i>
            </a>
        </div>
        
    </div>

@endsection