{{-- resources/views/Admin/Reviews/reviews.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Kelola Ulasan | Bakeryku')

@section('header_title', 'Review Moderation')
@section('header_subtitle', 'Kelola dan moderasi ulasan pelanggan sebelum ditampilkan.')

@section('header_actions')
    <div class="text-right">
        <span class="block font-heading text-3xl font-bold text-[#855333]">{{ $counts['all'] }}</span>
        <span class="text-xs text-gray-500 font-medium">Total Ulasan</span>
    </div>
@endsection

@section('content')

    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-bold flex items-center gap-2">
            <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center gap-3 mb-6 overflow-x-auto hide-scroll-bar pb-2">
        <a href="{{ route('admin.reviews.index', ['status' => 'all']) }}" class="flex items-center gap-2 px-4 py-2 {{ $status === 'all' ? 'bg-[#855333] text-white' : 'bg-[#EAE2D6] text-[#452A1B] hover:bg-[#DCD0C0]' }} rounded-lg text-sm font-bold shadow-sm transition">
            Semua Ulasan <span class="bg-{{ $status === 'all' ? 'white/20' : '[#452A1B]/10' }} px-2 py-0.5 rounded-full text-[10px]">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.reviews.index', ['status' => 'approved']) }}" class="flex items-center gap-2 px-4 py-2 {{ $status === 'approved' ? 'bg-[#855333] text-white' : 'bg-[#EAE2D6] text-[#452A1B] hover:bg-[#DCD0C0]' }} rounded-lg text-sm font-medium transition">
            Diterbitkan <span class="bg-{{ $status === 'approved' ? 'white/20' : '[#452A1B]/10' }} px-2 py-0.5 rounded-full text-[10px]">{{ $counts['approved'] }}</span>
        </a>
        <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}" class="flex items-center gap-2 px-4 py-2 {{ $status === 'pending' ? 'bg-[#855333] text-white' : 'bg-[#EAE2D6] text-[#452A1B] hover:bg-[#DCD0C0]' }} rounded-lg text-sm font-medium transition">
            Pending <span class="bg-{{ $status === 'pending' ? 'white/20' : '[#452A1B]/10' }} px-2 py-0.5 rounded-full text-[10px]">{{ $counts['pending'] }}</span>
        </a>
        <a href="{{ route('admin.reviews.index', ['status' => 'rejected']) }}" class="flex items-center gap-2 px-4 py-2 {{ $status === 'rejected' ? 'bg-[#855333] text-white' : 'bg-[#EAE2D6] text-[#452A1B] hover:bg-[#DCD0C0]' }} rounded-lg text-sm font-medium transition">
            Ditolak <span class="bg-{{ $status === 'rejected' ? 'white/20' : '[#452A1B]/10' }} px-2 py-0.5 rounded-full text-[10px]">{{ $counts['rejected'] }}</span>
        </a>
    </div>

    <div class="space-y-4">
        
        @forelse($reviews as $review)
            <div class="bg-white rounded-xl p-5 md:p-6 shadow-sm border border-[#EAE2D6] flex flex-col md:flex-row gap-5 {{ $review->status !== 'approved' ? 'opacity-75' : '' }}">
                <div class="hidden md:flex w-12 h-12 rounded-full bg-[#FAF8F5] text-[#855333] items-center justify-center font-bold text-lg border border-[#EAE2D6] flex-shrink-0">
                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                </div>
                
                <div class="flex-grow">
                    <div class="flex justify-between items-start mb-1">
                        <div>
                            <div class="flex items-center gap-3 mb-1 flex-wrap">
                                <h3 class="font-bold text-[#452A1B] text-base">{{ $review->user->name }}</h3>
                                <div class="flex text-yellow-400 text-[10px]">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fa-solid fa-star"></i>
                                        @else
                                            <i class="fa-regular fa-star text-gray-300"></i>
                                        @endif
                                    @endfor
                                </div>
                                @if($review->status === 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 text-[10px] px-2 py-0.5 rounded-full font-bold">Pending</span>
                                @elseif($review->status === 'approved')
                                    <span class="bg-green-100 text-green-700 text-[10px] px-2 py-0.5 rounded-full font-bold">Diterbitkan</span>
                                @elseif($review->status === 'rejected')
                                    <span class="bg-red-100 text-red-700 text-[10px] px-2 py-0.5 rounded-full font-bold">Ditolak</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500">Produk: <span class="font-bold text-[#452A1B]">{{ $review->product->name }}</span></p>
                        </div>
                        <span class="text-xs text-gray-400">{{ $review->created_at->format('d M Y') }}</span>
                    </div>

                    @if($review->comment)
                        <div class="mt-4 p-4 rounded-lg bg-[#FAF8F5] border border-[#EAE2D6]/50">
                            <p class="text-sm text-gray-700 italic">"{{ $review->comment }}"</p>
                        </div>
                    @endif

                    @if($review->admin_response && $review->status === 'rejected')
                        <div class="mt-3 p-3 rounded-lg bg-red-50 border border-red-200">
                            <p class="text-xs font-bold text-red-700 mb-1">Alasan Penolakan:</p>
                            <p class="text-sm text-red-600">{{ $review->admin_response }}</p>
                        </div>
                    @elseif($review->admin_response)
                        <div class="mt-3 p-3 rounded-lg bg-blue-50 border border-blue-200">
                            <p class="text-xs font-bold text-blue-700 mb-1">Respon Admin:</p>
                            <p class="text-sm text-blue-600">{{ $review->admin_response }}</p>
                        </div>
                    @endif

                    <div class="flex flex-wrap justify-end gap-2 mt-4 md:hidden border-t border-[#EAE2D6] pt-4">
                        @if($review->status === 'pending')
                            <button class="text-green-600 hover:bg-green-50 px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5" onclick="approveReview({{ $review->id }})">
                                <i class="fa-regular fa-circle-check"></i> Setujui
                            </button>
                            <button class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5" onclick="openRejectModal({{ $review->id }})">
                                <i class="fa-regular fa-circle-xmark"></i> Tolak
                            </button>
                        @endif
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5" onclick="return confirm('Yakin ingin menghapus review ini?')">
                                <i class="fa-regular fa-trash-can"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <div class="hidden md:flex flex-col gap-2 items-end justify-center pl-4 border-l border-[#EAE2D6]">
                    @if($review->status === 'pending')
                        <button class="text-green-600 hover:bg-green-50 w-10 h-10 rounded-lg flex items-center justify-center transition shadow-sm bg-white" onclick="approveReview({{ $review->id }})" title="Setujui Ulasan">
                            <i class="fa-regular fa-circle-check text-lg"></i>
                        </button>
                        <button class="text-red-500 hover:bg-red-50 w-10 h-10 rounded-lg flex items-center justify-center transition" onclick="openRejectModal({{ $review->id }})" title="Tolak Ulasan">
                            <i class="fa-regular fa-circle-xmark text-lg"></i>
                        </button>
                    @endif
                    <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-500 hover:bg-red-50 w-10 h-10 rounded-lg flex items-center justify-center transition" title="Hapus Ulasan" onclick="return confirm('Yakin ingin menghapus review ini?')">
                            <i class="fa-regular fa-trash-can text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl p-12 shadow-sm border border-[#EAE2D6] text-center">
                <i class="fa-regular fa-inbox text-gray-400 text-5xl block mb-4"></i>
                <p class="text-gray-500 font-medium">Tidak ada ulasan untuk ditampilkan</p>
            </div>
        @endforelse

    </div>

    <!-- Pagination -->
    @if($reviews->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $reviews->links() }}
        </div>
    @endif

    <!-- Reject Modal -->
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

        function approveReview(reviewId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/reviews/${reviewId}/approve`;
            form.innerHTML = '@csrf';
            document.body.appendChild(form);
            form.submit();
        }

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

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>

@endsection
