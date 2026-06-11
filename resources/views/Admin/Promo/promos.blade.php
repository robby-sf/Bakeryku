{{-- resources/views/Admin/Promo/promos.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Daftar Promos | Slice Bread Bakery')

@section('header_title', 'Kelola Promos & Diskon')
@section('header_subtitle', 'Pantau dan atur seluruh penawaran spesial untuk pelanggan.')

@php
    $currentStatus = $status ?? request('status', 'all');
    $tabs = [
        'all' => ['label' => 'Semua Promo', 'route' => route('admin.promos')],
        'running' => ['label' => 'Berjalan', 'route' => route('admin.promos', ['status' => 'running'])],
        'upcoming' => ['label' => 'Akan Datang', 'route' => route('admin.promos', ['status' => 'upcoming'])],
        'expired' => ['label' => 'Berakhir', 'route' => route('admin.promos', ['status' => 'expired'])],
    ];

    $statusClasses = [
        'Berjalan' => 'bg-[#E6F4EA] text-[#1E8E3E] border-[#1E8E3E]/20',
        'Akan Datang' => 'bg-[#FEF7E0] text-[#B06000] border-[#B06000]/20',
        'Berakhir' => 'bg-[#F1F3F4] text-[#5F6368] border-gray-300',
    ];
@endphp

@section('content')

    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-bold flex items-center gap-2">
            <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-[#EAE2D6] overflow-hidden">
        <div class="p-5 md:p-6 border-b border-[#EAE2D6] flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex gap-2 overflow-x-auto hide-scroll-bar w-full md:w-auto pb-2 md:pb-0">
                @foreach ($tabs as $key => $tab)
                    <a href="{{ $tab['route'] }}"
                       class="px-4 py-2 text-sm rounded-lg whitespace-nowrap transition-colors {{ $currentStatus === $key ? 'bg-[#855333] text-white font-bold shadow-sm' : 'bg-[#FAF8F5] border border-[#EAE2D6] hover:bg-[#EAE2D6] text-[#452A1B] font-medium' }}">
                        {{ $tab['label'] }}
                    </a>
                @endforeach
            </div>

            <a href="{{ route('admin.promos.add') }}" class="w-full md:w-auto bg-[#452A1B] hover:bg-[#5C3925] text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm flex items-center justify-center gap-2">
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
                    @forelse ($promos as $promo)
                        <tr class="hover:bg-[#FAF8F5]/50 transition-colors group {{ $promo->status === 'Berakhir' ? 'opacity-60 hover:opacity-100' : '' }}">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-4">
                                    @if ($promo->image)
                                        <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->title }}" class="w-16 h-10 rounded object-cover shadow-sm border border-gray-100 {{ $promo->status === 'Berakhir' ? 'grayscale' : '' }}">
                                    @else
                                        <div class="w-16 h-10 rounded bg-[#EAE2D6] flex items-center justify-center text-[#855333]">
                                            <i class="fa-solid fa-gift"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-[#452A1B] text-sm">{{ $promo->title }}</p>
                                        <p class="text-xs text-gray-500 line-clamp-1 max-w-[240px]">{{ $promo->description ?: 'Tidak ada deskripsi.' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="block text-sm font-bold text-[#855333]">{{ $promo->type_label }}</span>
                                <span class="text-xs text-gray-500">{{ $promo->value_label }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="block text-sm font-medium text-[#452A1B]">{{ $promo->start_date->translatedFormat('d M Y') }}</span>
                                <span class="text-xs text-gray-400">s/d {{ $promo->end_date->translatedFormat('d M Y') }}</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $statusClasses[$promo->status] ?? $statusClasses['Berakhir'] }}">
                                    @if ($promo->status === 'Berjalan')
                                        <span class="w-1.5 h-1.5 bg-[#1E8E3E] rounded-full animate-pulse"></span>
                                    @elseif ($promo->status === 'Akan Datang')
                                        <i class="fa-regular fa-clock"></i>
                                    @else
                                        <i class="fa-solid fa-ban"></i>
                                    @endif
                                    {{ $promo->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.promos.edit', $promo) }}" class="text-[#BA8E60] hover:text-[#855333] hover:bg-[#EAE2D6] p-2 rounded-lg transition-colors" title="Edit Promo">
                                        <i class="fa-regular fa-pen-to-square text-lg"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.promos.destroy', $promo) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus promo ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[#DE5B6D] hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus Promo">
                                            <i class="fa-regular fa-trash-can text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 px-6 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 rounded-full bg-[#FAF8F5] flex items-center justify-center text-[#BA8E60] text-3xl">
                                        <i class="fa-solid fa-bullhorn"></i>
                                    </div>
                                    <p class="text-gray-500 font-medium">Belum ada promo untuk filter ini.</p>
                                    <a href="{{ route('admin.promos.add') }}" class="text-[#855333] font-bold hover:text-[#452A1B] text-sm">
                                        <i class="fa-solid fa-plus"></i> Tambah Promo
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-[#EAE2D6] bg-[#FAF8F5] flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-gray-500">
            @if ($promos->total() > 0)
                <span>Menampilkan {{ $promos->firstItem() }}-{{ $promos->lastItem() }} dari {{ $promos->total() }} promos.</span>
            @else
                <span>Menampilkan 0 promos.</span>
            @endif
            @if ($promos->hasPages())
                <div class="admin-pagination">{{ $promos->links() }}</div>
            @endif
        </div>
    </div>

@endsection
