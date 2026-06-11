{{-- resources/views/Admin/Reviews/show.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Detail Ulasan | Bakeryku')

@section('header_title', 'Detail Ulasan')
@section('header_subtitle', 'Lihat, balas, atau sembunyikan ulasan pelanggan.')

@section('header_actions')
    <a href="{{ route('admin.reviews.index') }}" class="bg-white border border-[#EAE2D6] text-[#855333] hover:bg-[#FAF8F5] px-4 py-2.5 rounded-lg text-sm font-bold transition shadow-sm flex items-center gap-2">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Ulasan
    </a>
@endsection

@section('content')

    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-bold flex items-center gap-2">
            <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-[#EAE2D6] p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-[#452A1B]">Ulasan oleh {{ $review->user->name }}</h2>
                <p class="text-sm text-gray-500">Produk: <span class="font-semibold text-[#452A1B]">{{ $review->product->name }}</span></p>
            </div>
            <div class="flex items-center gap-2">
                @if($review->status === 'published')
                    <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold border border-green-200">
                        <i class="fa-solid fa-eye text-[10px]"></i> Diterbitkan
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-gray-200 text-gray-600 text-xs font-semibold border border-gray-300">
                        <i class="fa-solid fa-eye-slash text-[10px]"></i> Disembunyikan
                    </span>
                @endif
                <span class="text-xs text-gray-400">{{ $review->created_at->format('d M Y H:i') }}</span>
            </div>
        </div>

        <div class="mb-6">
            <div class="flex items-center gap-1 text-yellow-400 text-sm mb-3">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $review->rating)
                        <i class="fa-solid fa-star"></i>
                    @else
                        <i class="fa-regular fa-star text-gray-300"></i>
                    @endif
                @endfor
            </div>
            <div class="bg-[#FAF8F5] p-5 rounded-2xl border border-[#EAE2D6]">
                <p class="text-sm text-gray-700">{{ $review->comment ?: 'Tidak ada komentar tambahan.' }}</p>
            </div>
        </div>

        {{-- Admin Response --}}
        @if($review->admin_response)
            <div class="mb-6 p-4 rounded-2xl bg-blue-50 border border-blue-100">
                <p class="text-xs font-bold text-blue-700 mb-2"><i class="fa-solid fa-reply mr-1"></i>Balasan Admin</p>
                <p class="text-sm text-blue-600">{{ $review->admin_response }}</p>
            </div>
        @endif

        {{-- Reply Form --}}
        <div class="mb-6 p-5 rounded-2xl bg-[#FAF8F5] border border-[#EAE2D6]">
            <h3 class="font-bold text-[#452A1B] text-sm mb-3"><i class="fa-solid fa-reply mr-1 text-blue-600"></i> {{ $review->admin_response ? 'Ubah Balasan' : 'Tulis Balasan' }}</h3>
            <form method="POST" action="{{ route('admin.reviews.respond', $review->id) }}">
                @csrf
                <textarea name="response" rows="3" required placeholder="Tulis balasan untuk ulasan ini..." class="w-full bg-white border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors placeholder-gray-400 mb-3">{{ $review->admin_response }}</textarea>
                <div class="flex justify-end">
                    <button type="submit" class="px-5 py-2 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        {{ $review->admin_response ? 'Perbarui Balasan' : 'Kirim Balasan' }}
                    </button>
                </div>
            </form>
        </div>

        <div class="grid gap-3 md:grid-cols-3">
            @if($review->status === 'published')
                <form method="POST" action="{{ route('admin.reviews.hide', $review->id) }}">
                    @csrf
                    <button type="submit" class="w-full bg-yellow-50 text-yellow-700 border border-yellow-200 px-4 py-3 rounded-xl text-sm font-bold hover:bg-yellow-100 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-eye-slash"></i> Sembunyikan
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.reviews.unhide', $review->id) }}">
                    @csrf
                    <button type="submit" class="w-full bg-green-50 text-green-700 border border-green-200 px-4 py-3 rounded-xl text-sm font-bold hover:bg-green-100 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-eye"></i> Tampilkan Kembali
                    </button>
                </form>
            @endif
            <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin menghapus review ini?')" class="w-full bg-red-50 text-red-600 border border-red-200 px-4 py-3 rounded-xl text-sm font-bold hover:bg-red-100 transition flex items-center justify-center gap-2">
                    <i class="fa-regular fa-trash-can"></i> Hapus Review
                </button>
            </form>
            <a href="{{ route('admin.reviews.index', ['status' => 'all']) }}" class="w-full inline-flex items-center justify-center bg-white border border-[#EAE2D6] text-[#855333] px-4 py-3 rounded-xl text-sm font-bold hover:bg-[#FAF8F5] transition">
                Lihat Semua Ulasan
            </a>
        </div>
    </div>
@endsection
