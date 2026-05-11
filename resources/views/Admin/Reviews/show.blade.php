{{-- resources/views/Admin/Reviews/show.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Detail Ulasan | Bakeryku')

@section('header_title', 'Detail Ulasan')
@section('header_subtitle', 'Lihat dan moderasi ulasan pelanggan secara detail.')

@section('header_actions')
    <a href="{{ route('admin.reviews.index') }}" class="bg-white border border-[#EAE2D6] text-[#855333] hover:bg-[#FAF8F5] px-4 py-2.5 rounded-lg text-sm font-bold transition shadow-sm flex items-center gap-2">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Ulasan
    </a>
@endsection

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-[#EAE2D6] p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-[#452A1B]">Ulasan oleh {{ $review->user->name }}</h2>
                <p class="text-sm text-gray-500">Produk: <span class="font-semibold text-[#452A1B]">{{ $review->product->name }}</span></p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-[#FAF8F5] text-[#452A1B] text-xs font-semibold border border-[#EAE2D6]">{{ ucfirst($review->status) }}</span>
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

        @if($review->admin_response)
            <div class="mb-6 p-4 rounded-2xl bg-blue-50 border border-blue-100">
                <p class="text-xs font-bold text-blue-700 mb-2">Respon Admin</p>
                <p class="text-sm text-blue-600">{{ $review->admin_response }}</p>
            </div>
        @endif

        <div class="grid gap-3 md:grid-cols-3">
            @if($review->status === 'pending')
                <form method="POST" action="{{ route('admin.reviews.approve', $review->id) }}" class="">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 text-white px-4 py-3 rounded-xl text-sm font-bold hover:bg-green-700 transition">Setujui</button>
                </form>
                <button type="button" onclick="openRejectModal({{ $review->id }})" class="w-full bg-red-50 text-red-600 border border-red-200 px-4 py-3 rounded-xl text-sm font-bold hover:bg-red-100 transition">Tolak</button>
            @endif
            <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" class="">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin menghapus review ini?')" class="w-full bg-[#EAE2D6] text-[#452A1B] px-4 py-3 rounded-xl text-sm font-bold hover:bg-[#DCD0C0] transition">Hapus Review</button>
            </form>
            <a href="{{ route('admin.reviews.index', ['status' => 'all']) }}" class="w-full inline-flex items-center justify-center bg-white border border-[#EAE2D6] text-[#855333] px-4 py-3 rounded-xl text-sm font-bold hover:bg-[#FAF8F5] transition">Lihat Semua Ulasan</a>
        </div>
    </div>

    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 md:p-8 max-w-md w-full mx-4">
            <h2 class="font-heading text-xl font-bold text-[#452A1B] mb-4">Tolak Ulasan</h2>
            <form method="POST" id="rejectForm">
                @csrf
                <div class="mb-4">
                    <label for="reason" class="block text-sm font-bold text-[#855333] mb-2">Alasan Penolakan (Opsional)</label>
                    <textarea id="reason" name="reason" rows="4" placeholder="Tuliskan alasan penolakan ulasan..." class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors placeholder-gray-400"></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" class="px-4 py-2 rounded-lg text-sm font-bold text-[#855333] hover:bg-[#EAE2D6] transition-colors" onclick="closeRejectModal()">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg text-sm font-bold text-white bg-red-500 hover:bg-red-600 transition-colors">
                        Tolak Review
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentReviewId = null;

        function openRejectModal(reviewId) {
            currentReviewId = reviewId;
            const form = document.getElementById('rejectForm');
            form.action = `/admin/reviews/${reviewId}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('flex');
            currentReviewId = null;
        }

        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>
@endsection
