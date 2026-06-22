{{-- resources/views/Admin/Reviews/reviews.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Ulasan | Bakeryku')

@section('header_title', 'Kelola Komentar')
@section('header_subtitle', 'Kelola, balas, dan sembunyikan ulasan pelanggan.')

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
        <a href="{{ route('admin.reviews.index', ['status' => 'published']) }}" class="flex items-center gap-2 px-4 py-2 {{ $status === 'published' ? 'bg-[#855333] text-white' : 'bg-[#EAE2D6] text-[#452A1B] hover:bg-[#DCD0C0]' }} rounded-lg text-sm font-medium transition">
            Diterbitkan <span class="bg-{{ $status === 'published' ? 'white/20' : '[#452A1B]/10' }} px-2 py-0.5 rounded-full text-[10px]">{{ $counts['published'] }}</span>
        </a>
        <a href="{{ route('admin.reviews.index', ['status' => 'hidden']) }}" class="flex items-center gap-2 px-4 py-2 {{ $status === 'hidden' ? 'bg-[#855333] text-white' : 'bg-[#EAE2D6] text-[#452A1B] hover:bg-[#DCD0C0]' }} rounded-lg text-sm font-medium transition">
            Disembunyikan <span class="bg-{{ $status === 'hidden' ? 'white/20' : '[#452A1B]/10' }} px-2 py-0.5 rounded-full text-[10px]">{{ $counts['hidden'] }}</span>
        </a>
    </div>

    <div class="space-y-4">
        
        @forelse($reviews as $review)
            <div class="bg-white rounded-xl p-5 md:p-6 shadow-sm border border-[#EAE2D6] {{ $review->status === 'hidden' ? 'opacity-60' : '' }}">
                <div class="flex flex-col md:flex-row gap-5">
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
                                    @if($review->status === 'published')
                                        <span class="bg-green-100 text-green-700 text-[10px] px-2 py-0.5 rounded-full font-bold">Diterbitkan</span>
                                    @elseif($review->status === 'hidden')
                                        <span class="bg-gray-200 text-gray-600 text-[10px] px-2 py-0.5 rounded-full font-bold">Disembunyikan</span>
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

                        {{-- Admin Response Display --}}
                        @if($review->admin_response)
                            <div class="mt-3 p-3 rounded-lg bg-blue-50 border border-blue-200">
                                <p class="text-xs font-bold text-blue-700 mb-1"><i class="fa-solid fa-reply mr-1"></i>Balasan Admin:</p>
                                <p class="text-sm text-blue-600">{{ $review->admin_response }}</p>
                            </div>
                        @endif

                        {{-- Action buttons (mobile) --}}
                        <div class="flex flex-wrap gap-2 mt-4 md:hidden border-t border-[#EAE2D6] pt-4">
                            {{-- Reply button --}}
                            <button class="text-blue-600 hover:bg-blue-50 px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5" onclick="openRespondModal({{ $review->id }}, '{{ addslashes($review->admin_response) }}')">
                                <i class="fa-solid fa-reply"></i> Balas
                            </button>
                            {{-- Hide/Unhide --}}
                            @if($review->status === 'published')
                                <button class="text-yellow-600 hover:bg-yellow-50 px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5" onclick="hideReview({{ $review->id }})">
                                    <i class="fa-solid fa-eye-slash"></i> Sembunyikan
                                </button>
                            @else
                                <button class="text-green-600 hover:bg-green-50 px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5" onclick="unhideReview({{ $review->id }})">
                                    <i class="fa-solid fa-eye"></i> Tampilkan
                                </button>
                            @endif
                            {{-- Delete --}}
                            <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded text-xs font-bold transition flex items-center gap-1.5" onclick="return confirm('Yakin ingin menghapus review ini?')">
                                    <i class="fa-regular fa-trash-can"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Desktop action buttons --}}
                    <div class="hidden md:flex flex-col gap-2 items-end justify-center pl-4 border-l border-[#EAE2D6]">
                        {{-- Reply --}}
                        <button class="text-blue-600 hover:bg-blue-50 w-10 h-10 rounded-lg flex items-center justify-center transition shadow-sm bg-white" onclick="openRespondModal({{ $review->id }}, '{{ addslashes($review->admin_response) }}')" title="Balas Ulasan">
                            <i class="fa-solid fa-reply text-lg"></i>
                        </button>
                        {{-- Hide/Unhide --}}
                        @if($review->status === 'published')
                            <button class="text-yellow-600 hover:bg-yellow-50 w-10 h-10 rounded-lg flex items-center justify-center transition" onclick="hideReview({{ $review->id }})" title="Sembunyikan Ulasan">
                                <i class="fa-solid fa-eye-slash text-lg"></i>
                            </button>
                        @else
                            <button class="text-green-600 hover:bg-green-50 w-10 h-10 rounded-lg flex items-center justify-center transition" onclick="unhideReview({{ $review->id }})" title="Tampilkan Ulasan">
                                <i class="fa-solid fa-eye text-lg"></i>
                            </button>
                        @endif
                        {{-- Delete --}}
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 hover:bg-red-50 w-10 h-10 rounded-lg flex items-center justify-center transition" title="Hapus Ulasan" onclick="return confirm('Yakin ingin menghapus review ini?')">
                                <i class="fa-regular fa-trash-can text-lg"></i>
                            </button>
                        </form>
                    </div>
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
        <div class="mt-8 flex justify-center admin-pagination">
            {{ $reviews->links() }}
        </div>
    @endif

    <div id="respondModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 md:p-8 max-w-md w-full mx-4">
            <h2 class="font-heading text-xl font-bold text-[#452A1B] mb-4"><i class="fa-solid fa-reply mr-2 text-blue-600"></i>Balas Ulasan</h2>
            <form method="POST" id="respondForm">
                @csrf
                <div class="mb-4">
                    <label for="response" class="block text-sm font-bold text-[#855333] mb-2">Balasan Admin</label>
                    <textarea id="responseText" name="response" rows="4" required placeholder="Tuliskan balasan untuk ulasan ini..." class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors placeholder-gray-400"></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" class="px-4 py-2 rounded-lg text-sm font-bold text-[#855333] hover:bg-[#EAE2D6] transition-colors" onclick="closeRespondModal()">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        Kirim Balasan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function hideReview(reviewId) {
            if (!confirm('Sembunyikan ulasan ini dari publik?')) return;
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/reviews/${reviewId}/hide`;
            form.innerHTML = '@csrf';
            document.body.appendChild(form);
            form.submit();
        }

        function unhideReview(reviewId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/reviews/${reviewId}/unhide`;
            form.innerHTML = '@csrf';
            document.body.appendChild(form);
            form.submit();
        }

        function openRespondModal(reviewId, existingResponse) {
            const form = document.getElementById('respondForm');
            form.action = `/admin/reviews/${reviewId}/respond`;
            document.getElementById('responseText').value = existingResponse || '';
            document.getElementById('respondModal').classList.remove('hidden');
            document.getElementById('respondModal').classList.add('flex');
        }

        function closeRespondModal() {
            document.getElementById('respondModal').classList.add('hidden');
            document.getElementById('respondModal').classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('respondModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRespondModal();
            }
        });
    </script>

@endsection
