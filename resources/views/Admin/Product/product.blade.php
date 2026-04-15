{{-- resources/views/Admin/Menu/menu_list.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Daftar Menu | Ananda Bakery')

@section('header_title', 'Kelola Menu')
@section('header_subtitle', 'Atur daftar produk, harga, dan ketersediaan stok.')

@section('content')

    @php
        $dummyData = [
            ['name' => 'Classic Croissant', 'category' => 'Pastry', 'price' => 'Rp 25.000', 'status' => 'Tersedia', 'img' => 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Chocolate Lava Bun', 'category' => 'Roti Manis', 'price' => 'Rp 18.000', 'status' => 'Tersedia', 'img' => 'https://images.unsplash.com/photo-1608198093002-ad4e005484ec?q=80&w=2132&auto=format&fit=crop'],
            ['name' => 'Smoked Beef & Cheese', 'category' => 'Roti Asin', 'price' => 'Rp 22.000', 'status' => 'Tersedia', 'img' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=2072&auto=format&fit=crop'],
            ['name' => 'Almond Danish', 'category' => 'Pastry', 'price' => 'Rp 28.000', 'status' => 'Habis', 'img' => 'https://images.unsplash.com/photo-1509365465985-25d11c17e812?q=80&w=1914&auto=format&fit=crop'],
            ['name' => 'Blueberry Cheese Bun', 'category' => 'Roti Manis', 'price' => 'Rp 20.000', 'status' => 'Tersedia', 'img' => 'https://images.unsplash.com/photo-1576618148400-f54bed99fcfd?q=80&w=2080&auto=format&fit=crop'],
        ];
        
        // Menggandakan data menjadi 10 agar terlihat penuh 1 halaman
        $menus = array_merge($dummyData, $dummyData);
    @endphp

    <div class="bg-white rounded-2xl shadow-sm border border-[#EAE2D6] overflow-hidden">
        
        <div class="p-5 md:p-6 border-b border-[#EAE2D6] flex flex-col md:flex-row justify-between items-center gap-4">
            
            <h2 class="font-heading text-2xl font-bold text-[#452A1B]">Daftar Produk</h2>
            
            <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                
                <div class="flex items-center bg-[#FAF8F5] rounded-lg border border-[#EAE2D6] p-1 shadow-sm">
                    <button class="w-8 h-8 flex items-center justify-center text-gray-300 cursor-not-allowed" disabled>
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>
                    
                    <span class="px-3 text-sm font-bold text-[#452A1B]">
                        1 <span class="text-gray-400 font-normal mx-1">dari</span> 5
                    </span>
                    
                    <button class="w-8 h-8 flex items-center justify-center text-[#452A1B] hover:bg-[#EAE2D6] rounded-md transition-colors">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                </div>

                <a href="{{ route('admin.tambah_menu') }}" class="bg-[#452A1B] hover:bg-[#5C3925] text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i>
                    <span class="hidden sm:inline">Tambah Menu</span>
                </a>
                
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-[#FAF8F5] border-b border-[#EAE2D6]">
                        <th class="py-4 px-6 text-xs font-bold text-[#855333] tracking-wider uppercase">Produk</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#855333] tracking-wider uppercase">Kategori</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#855333] tracking-wider uppercase">Harga</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#855333] tracking-wider uppercase">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#855333] tracking-wider uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EAE2D6] bg-white">
                    
                    @foreach ($menus as $menu)
                    <tr class="hover:bg-[#FAF8F5]/50 transition-colors group">
                        
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <img src="{{ $menu['img'] }}" alt="{{ $menu['name'] }}" class="w-12 h-12 rounded-lg object-cover shadow-sm border border-gray-100 group-hover:shadow-md transition">
                                <span class="font-bold text-[#452A1B] text-base">{{ $menu['name'] }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-6">
                            <span class="text-sm font-medium text-gray-500">{{ $menu['category'] }}</span>
                        </td>

                        <td class="py-4 px-6">
                            <span class="text-sm font-bold text-[#855333]">{{ $menu['price'] }}</span>
                        </td>

                        <td class="py-4 px-6">
                            @if($menu['status'] == 'Tersedia')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#E6F4EA] text-[#1E8E3E] border border-[#1E8E3E]/20">
                                    <i class="fa-regular fa-circle-check"></i> Tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#FCE8E6] text-[#D93025] border border-[#D93025]/20">
                                    <i class="fa-regular fa-circle-xmark"></i> Habis
                                </span>
                            @endif
                        </td>

                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <button class="text-[#BA8E60] hover:text-[#855333] hover:bg-[#EAE2D6] p-2 rounded-lg transition-colors" title="Edit Menu">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>
                                <button class="text-[#DE5B6D] hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus Menu">
                                    <i class="fa-regular fa-trash-can text-lg"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-[#EAE2D6] bg-[#FAF8F5] text-xs text-gray-500 text-center md:text-left">
            Menampilkan <span class="font-bold text-[#452A1B]">1</span> hingga <span class="font-bold text-[#452A1B]">10</span> dari <span class="font-bold text-[#452A1B]">48</span> produk.
        </div>

    </div>

@endsection