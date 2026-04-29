{{-- resources/views/Admin/Promo/promos.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Daftar Promos | Slice Bread Bakery')

@section('header_title', 'Kelola Promos & Diskon')
@section('header_subtitle', 'Pantau dan atur seluruh penawaran spesial untuk pelanggan.')

@section('content')

    <div class="bg-white rounded-2xl shadow-sm border border-[#EAE2D6] overflow-hidden">
        
        <div class="p-5 md:p-6 border-b border-[#EAE2D6] flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="flex gap-2 overflow-x-auto hide-scroll-bar w-full md:w-auto pb-2 md:pb-0">
                <button class="px-4 py-2 bg-[#855333] text-white text-sm font-bold rounded-lg whitespace-nowrap shadow-sm">
                    Semua Promo
                </button>
                <button class="px-4 py-2 bg-[#FAF8F5] border border-[#EAE2D6] hover:bg-[#EAE2D6] text-[#452A1B] text-sm font-medium rounded-lg whitespace-nowrap transition-colors">
                    Berjalan
                </button>
                <button class="px-4 py-2 bg-[#FAF8F5] border border-[#EAE2D6] hover:bg-[#EAE2D6] text-[#452A1B] text-sm font-medium rounded-lg whitespace-nowrap transition-colors">
                    Akan Datang
                </button>
                <button class="px-4 py-2 bg-[#FAF8F5] border border-[#EAE2D6] hover:bg-[#EAE2D6] text-[#452A1B] text-sm font-medium rounded-lg whitespace-nowrap transition-colors">
                    Berakhir
                </button>
            </div>
            
            <a href="{{ route('admin.promos.add') ?? '/admin/addpromos' }}" class="w-full md:w-auto bg-[#452A1B] hover:bg-[#5C3925] text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm flex items-center justify-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Promo
            </a>
            
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                    <tr class="bg-[#FAF8F5] border-b border-[#EAE2D6]">
                        <th class="py-4 px-6 text-xs font-bold text-[#855333] tracking-wider uppercase">Info Promo</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#855333] tracking-wider uppercase">Tipe & Nilai</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#855333] tracking-wider uppercase">Periode</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#855333] tracking-wider uppercase text-center">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#855333] tracking-wider uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EAE2D6] bg-white">
                    
                    <tr class="hover:bg-[#FAF8F5]/50 transition-colors group">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <img src="https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?q=80&w=200&auto=format&fit=crop" alt="Banner" class="w-16 h-10 rounded object-cover shadow-sm border border-gray-100">
                                <div>
                                    <p class="font-bold text-[#452A1B] text-sm">Special Weekend Bundle</p>
                                    <p class="text-xs text-gray-500 line-clamp-1 max-w-[200px]">Diskon untuk 3 macam pastry.</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="block text-sm font-bold text-[#855333]">Paket Bundel</span>
                            <span class="text-xs text-gray-500">- 20%</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="block text-sm font-medium text-[#452A1B]">24 Apr 2026</span>
                            <span class="text-xs text-gray-400">s/d 30 Apr 2026</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#E6F4EA] text-[#1E8E3E] border border-[#1E8E3E]/20">
                                <div class="w-1.5 h-1.5 bg-[#1E8E3E] rounded-full animate-pulse"></div> Berjalan
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="text-[#BA8E60] hover:text-[#855333] hover:bg-[#EAE2D6] p-2 rounded-lg transition-colors" title="Edit Promo">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>
                                <button class="text-[#DE5B6D] hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus Promo">
                                    <i class="fa-regular fa-trash-can text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-[#FAF8F5]/50 transition-colors group">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-10 rounded bg-[#EAE2D6] flex items-center justify-center text-[#855333]">
                                    <i class="fa-solid fa-gift"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-[#452A1B] text-sm">Promo Beli 2 Gratis 1</p>
                                    <p class="text-xs text-gray-500 line-clamp-1 max-w-[200px]">Berlaku untuk semua Roti Asin.</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="block text-sm font-bold text-[#855333]">Buy 2 Get 1</span>
                            <span class="text-xs text-gray-500">-</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="block text-sm font-medium text-[#452A1B]">01 Mei 2026</span>
                            <span class="text-xs text-gray-400">s/d 05 Mei 2026</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#FEF7E0] text-[#B06000] border border-[#B06000]/20">
                                <i class="fa-regular fa-clock"></i> Akan Datang
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="text-[#BA8E60] hover:text-[#855333] hover:bg-[#EAE2D6] p-2 rounded-lg transition-colors" title="Edit Promo">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>
                                <button class="text-[#DE5B6D] hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus Promo">
                                    <i class="fa-regular fa-trash-can text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-[#FAF8F5]/50 transition-colors group opacity-60 hover:opacity-100">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=200&auto=format&fit=crop" alt="Banner" class="w-16 h-10 rounded object-cover shadow-sm border border-gray-100 grayscale">
                                <div>
                                    <p class="font-bold text-[#452A1B] text-sm">Ramadan Flash Sale</p>
                                    <p class="text-xs text-gray-500 line-clamp-1 max-w-[200px]">Diskon besar hampers lebaran.</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="block text-sm font-bold text-[#855333]">Diskon (%)</span>
                            <span class="text-xs text-gray-500">- 30%</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="block text-sm font-medium text-[#452A1B]">01 Apr 2026</span>
                            <span class="text-xs text-gray-400">s/d 15 Apr 2026</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#F1F3F4] text-[#5F6368] border border-gray-300">
                                <i class="fa-solid fa-ban"></i> Berakhir
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="text-[#BA8E60] hover:text-[#855333] hover:bg-[#EAE2D6] p-2 rounded-lg transition-colors" title="Edit Promo">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>
                                <button class="text-[#DE5B6D] hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus Promo">
                                    <i class="fa-regular fa-trash-can text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-[#EAE2D6] bg-[#FAF8F5] flex justify-between items-center text-xs text-gray-500">
            <span>Menampilkan 1-3 dari 3 promos.</span>
        </div>

    </div>

@endsection