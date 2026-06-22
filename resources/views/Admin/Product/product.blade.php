{{-- resources/views/Admin/Menu/menu_list.blade.php --}}
@extends('layouts.admin')

@section('title', 'Daftar Menu | Bakeryku')

@section('header_title', 'Kelola Menu')
@section('header_subtitle', 'Atur daftar produk, harga, dan ketersediaan stok.')

@section('content')

    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-bold flex items-center gap-2">
            <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-[#EAE2D6] overflow-hidden">
        
        <div class="p-5 md:p-6 border-b border-[#EAE2D6] flex flex-col md:flex-row justify-between items-center gap-4">
            
            <h2 class="font-heading text-2xl font-bold text-[#452A1B]">Daftar Produk</h2>
            
            <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                
                <div class="flex items-center bg-[#FAF8F5] rounded-lg border border-[#EAE2D6] p-1 shadow-sm">
                    @if ($products->onFirstPage())
                        <button class="w-8 h-8 flex items-center justify-center text-gray-300 cursor-not-allowed" disabled>
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </button>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center text-[#452A1B] hover:bg-[#EAE2D6] rounded-md transition-colors">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </a>
                    @endif
                    
                    <span class="px-3 text-sm font-bold text-[#452A1B]">
                        {{ $products->currentPage() }} <span class="text-gray-400 font-normal mx-1">dari</span> {{ $products->lastPage() }}
                    </span>
                    
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center text-[#452A1B] hover:bg-[#EAE2D6] rounded-md transition-colors">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </a>
                    @else
                        <button class="w-8 h-8 flex items-center justify-center text-gray-300 cursor-not-allowed" disabled>
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    @endif
                </div>

                <a href="{{ route('admin.products.create') }}" class="bg-[#452A1B] hover:bg-[#5C3925] text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm flex items-center gap-2">
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
                    
                    @forelse ($products as $product)
                    <tr class="hover:bg-[#FAF8F5]/50 transition-colors group">
                        
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover shadow-sm border border-gray-100 group-hover:shadow-md transition">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-[#EAE2D6] flex items-center justify-center text-gray-400">
                                        <i class="fa-regular fa-image text-lg"></i>
                                    </div>
                                @endif
                                <span class="font-bold text-[#452A1B] text-base">{{ $product->name }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-6">
                            <span class="text-sm font-medium text-gray-500">{{ $product->category }}</span>
                        </td>

                        <td class="py-4 px-6">
                            <span class="text-sm font-bold text-[#855333]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </td>

                        <td class="py-4 px-6">
                            @if($product->status == 'Tersedia')
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
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-[#BA8E60] hover:text-[#855333] hover:bg-[#EAE2D6] p-2 rounded-lg transition-colors" title="Edit Menu">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </a>
                                
                                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#DE5B6D] hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus Menu">
                                        <i class="fa-regular fa-trash-can text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 px-6 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-full bg-[#FAF8F5] flex items-center justify-center text-[#BA8E60] text-3xl">
                                    <i class="fa-regular fa-inbox"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada produk. Silakan tambahkan produk baru.</p>
                                <a href="{{ route('admin.products.create') }}" class="text-[#855333] font-bold hover:text-[#452A1B] text-sm">
                                    <i class="fa-solid fa-plus"></i> Tambah Produk
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>

        @if ($products->hasPages())
        <div class="border-t border-[#EAE2D6] p-6 flex justify-between items-center">
            <p class="text-sm text-gray-500">
                Menampilkan <span class="font-bold text-[#452A1B]">{{ $products->firstItem() }}</span> hingga 
                <span class="font-bold text-[#452A1B]">{{ $products->lastItem() }}</span> dari 
                <span class="font-bold text-[#452A1B]">{{ $products->total() }}</span> produk
            </p>
            <div class="flex gap-2 admin-pagination">
                {{ $products->links() }}
            </div>
        </div>
        @endif
    </div>

@endsection