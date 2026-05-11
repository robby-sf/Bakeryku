@extends('layouts.app')

@section('title', $product->name . ' | Slice Bread Bakery')

@section('content')
    <div class="py-8 md:py-12">
        <div class="container mx-auto px-4 md:px-6 max-w-5xl">
            
            <a href="/menu" class="inline-flex items-center gap-2 text-brand-primary hover:text-brand-dark transition font-medium mb-6 md:mb-8 text-sm md:text-base">
                <i class="fa-solid fa-arrow-left"></i> Back to Catalog
            </a>

            <div class="flex flex-col md:flex-row gap-8 lg:gap-12 mb-16 md:mb-24">
                
                <div class="w-full md:w-1/2 flex flex-col gap-4">
                    @php
                        $galleryImages = collect([$product->image, $product->image_2, $product->image_3])->filter()->values();
                        $galleryPlaceholder = 'https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?q=80&w=800&auto=format&fit=crop';
                    @endphp

                    <div class="bg-[#EAE4D9] rounded-2xl aspect-square flex items-center justify-center p-8 overflow-hidden">
                        <img src="{{ $galleryImages->first() ? Storage::url($galleryImages->first()) : $galleryPlaceholder }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-xl mix-blend-multiply opacity-90 hover:scale-105 transition duration-500">
                    </div>
                    @if ($galleryImages->count())
                        <div class="flex gap-4">
                            @foreach($galleryImages->take(3) as $image)
                                <button type="button" class="w-20 h-20 bg-[#EAE4D9] rounded-xl overflow-hidden border-2 border-transparent hover:border-brand-primary transition p-1 opacity-70 hover:opacity-100">
                                    <img src="{{ Storage::url($image) }}" class="w-full h-full object-cover rounded-lg mix-blend-multiply" alt="{{ $product->name }} gallery">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="w-full md:w-1/2 flex flex-col justify-start pt-2">
                    
                    <div class="mb-3">
                        <span class="bg-[#C28C62] text-white text-[10px] md:text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wide">{{ $product->category }}</span>
                    </div>
                    
                    <h1 class="font-heading text-3xl md:text-4xl font-bold text-brand-dark mb-2">{{ $product->name }}</h1>
                    <div class="flex items-center gap-2 mb-6">
                        <span class="font-bold text-brand-dark text-lg">{{ number_format($averageRating, 1) }}</span>
                        <div class="flex text-yellow-400 text-sm">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < intval($averageRating))
                                    <i class="fa-solid fa-star"></i>
                                @elseif ($i < $averageRating)
                                    <i class="fa-regular fa-star-half-stroke"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-sm text-gray-500 ml-1">({{ $reviewCount }} reviews)</span>
                    </div>

                    <hr class="border-gray-200 mb-6">

                    <div class="mb-6">
                        <div class="font-bold text-brand-primary text-3xl md:text-4xl mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="flex items-center gap-2 {{ $product->status === 'Tersedia' ? 'text-green-600' : 'text-red-600' }} font-medium text-sm">
                            <i class="fa-solid fa-{{ $product->status === 'Tersedia' ? 'check' : 'x' }}"></i> {{ $product->status === 'Tersedia' ? 'In Stock' : 'Out of Stock' }}
                        </div>
                    </div>

                    <hr class="border-gray-200 mb-6">

                    <div class="mb-8">
                        <h3 class="font-bold text-brand-dark mb-2 text-sm md:text-base">Description</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            {{ $product->description ?? 'Produk berkualitas premium dari Slice Bread Bakery yang dibuat dengan resep terbaik dan bahan-bahan pilihan.' }}
                        </p>
                    </div>

                    <div class="flex flex-col gap-6 mt-auto">
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-brand-dark text-sm">Quantity:</span>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden w-32 bg-white quantity-input">
                                <button class="quantity-minus px-4 py-2 text-gray-600 hover:bg-gray-100 transition"><i class="fa-solid fa-minus text-xs"></i></button>
                                <input type="text" id="quantity-display" value="1" class="quantity-value w-full text-center py-2 font-semibold text-brand-dark focus:outline-none" readonly>
                                <button class="quantity-plus px-4 py-2 text-gray-600 hover:bg-gray-100 transition"><i class="fa-solid fa-plus text-xs"></i></button>
                            </div>
                        </div>

                        <div class="flex flex-wrap md:flex-nowrap gap-3">
                        @if(Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'user')
                            <form action="{{ route('orders.whatsapp') }}" method="POST" class="flex-grow">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" id="order-quantity" name="quantity" value="1">
                                <button type="submit" class="w-full bg-[#8C5230] hover:bg-[#683b21] text-white font-semibold py-3 px-6 rounded-xl transition duration-300 shadow-md flex justify-center items-center gap-2 text-sm md:text-base">
                                    Order via WhatsApp
                                </button>
                            </form>

                            <form action="{{ route('favorites.toggle') }}" method="POST" class="flex-shrink-0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="heart-btn w-12 h-12 md:w-14 md:h-14 flex justify-center items-center border rounded-xl transition bg-white shadow-sm" style="border-color: {{ $isFavorited ? '#f87171' : '#d1d5db' }}; color: {{ $isFavorited ? '#dc2626' : '#6b7280' }};">
                                    <i class="fa-{{ $isFavorited ? 'solid' : 'regular' }} fa-heart text-lg md:text-xl"></i>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="flex-grow bg-[#8C5230] hover:bg-[#683b21] text-white font-semibold py-3 px-6 rounded-xl transition duration-300 shadow-md flex justify-center items-center gap-2 text-sm md:text-base">
                                Order via WhatsApp
                            </a>
                            <a href="{{ route('login') }}" class="heart-btn w-12 h-12 md:w-14 md:h-14 flex justify-center items-center border border-gray-300 rounded-xl text-gray-500 hover:text-red-500 hover:border-red-500 transition bg-white shadow-sm flex-shrink-0">
                                <i class="fa-regular fa-heart text-lg md:text-xl"></i>
                            </a>
                        @endif

                        <button class="share-btn w-12 h-12 md:w-14 md:h-14 flex justify-center items-center border border-gray-300 rounded-xl text-gray-500 hover:text-brand-primary hover:border-brand-primary transition bg-white shadow-sm flex-shrink-0">
                            <i class="fa-solid fa-share-nodes text-lg md:text-xl"></i>
                        </button>
                    </div>
                    </div>

                </div>
            </div>

            <section class="border-t border-gray-200 pt-10 md:pt-12">
                
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-8">
                    <div>
                        <h2 class="font-heading text-2xl md:text-3xl font-bold text-brand-dark mb-4 flex items-center gap-2">
                            Ulasan Pelanggan <span class="text-[#C28C62] font-normal text-xl md:text-2xl">(2)</span>
                        </h2>
                        
                        <div class="flex items-center gap-4">
                            <div class="text-4xl md:text-5xl font-bold text-brand-dark">4.9</div>
                            <div class="flex flex-col">
                                <div class="flex text-yellow-400 text-lg mb-1">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star-half-stroke"></i>
                                </div>
                                <span class="text-xs text-gray-500">Berdasarkan 234 ulasan</span>
                            </div>
                        </div>
                    </div>

                    @if(Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'user')
                    <button id="btn-tulis-ulasan" class="bg-white border-2 border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-white font-semibold py-2 md:py-3 px-6 rounded-full transition duration-300 w-full md:w-auto text-sm md:text-base cursor-pointer flex justify-center items-center">
                        <i class="fa-solid fa-pen mr-2"></i> Tulis Ulasan
                    </button>
                    @else
                    <a href="/login" class="bg-white border-2 border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-white font-semibold py-2 md:py-3 px-6 rounded-full transition duration-300 w-full md:w-auto text-sm md:text-base cursor-pointer flex justify-center items-center">
                        <i class="fa-solid fa-sign-in-alt mr-2"></i> Login untuk Memberi Ulasan
                    </a>
                    @endif
                </div>

                @if(Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'user')
                <div id="form-ulasan-container" class="hidden bg-[#FFFDFB] border border-[#F0EBE1] rounded-2xl p-6 md:p-8 shadow-sm mb-8 transform transition-all">
                    <h3 class="font-bold text-brand-dark mb-1 text-lg">Bagaimana penilaian Anda?</h3>
                    <p class="text-sm text-gray-500 mb-6">Ulasan Anda membantu kami meningkatkan kualitas produk.</p>
                    
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-brand-dark mb-2">Pilih Rating</label>
                            <div class="flex text-gray-300 text-3xl cursor-pointer gap-2" id="star-rating">
                                <i class="fa-solid fa-star hover:scale-110 transition-transform" data-value="1"></i>
                                <i class="fa-solid fa-star hover:scale-110 transition-transform" data-value="2"></i>
                                <i class="fa-solid fa-star hover:scale-110 transition-transform" data-value="3"></i>
                                <i class="fa-solid fa-star hover:scale-110 transition-transform" data-value="4"></i>
                                <i class="fa-solid fa-star hover:scale-110 transition-transform" data-value="5"></i>
                            </div>
                            <input type="hidden" name="rating" id="rating-input" required>
                            <p id="rating-error" class="text-red-500 text-xs mt-1 hidden">Silakan pilih rating bintang terlebih dahulu.</p>
                        </div>

                        <div class="mb-6">
                            <label for="komentar" class="block text-sm font-semibold text-brand-dark mb-2">Tulis Komentar</label>
                            <textarea id="komentar" name="comment" rows="4" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#C28C62] focus:ring-1 focus:ring-[#C28C62] outline-none transition bg-white text-sm" 
                                placeholder="Ceritakan pengalaman Anda (rasa, tekstur, pelayanan, dll)..."></textarea>
                        </div>

                        <div class="flex justify-end gap-3">
                            <button type="button" id="btn-batal-ulasan" class="px-6 py-2.5 rounded-xl text-sm font-bold text-gray-500 hover:bg-gray-100 transition-colors">Batal</button>
                            <button type="submit" class="bg-[#8C5230] hover:bg-[#683b21] text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-colors">Kirim Ulasan</button>
                        </div>
                    </form>
                </div>
                @endif

                <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-6 scrollbar-hide snap-x">
                    <button class="snap-start flex-shrink-0 px-4 py-2 bg-brand-primary text-white text-xs md:text-sm font-medium rounded-full whitespace-nowrap shadow-sm">
                        Semua
                    </button>
                    <button class="snap-start flex-shrink-0 px-4 py-2 bg-white hover:bg-gray-50 border border-gray-200 text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition flex items-center gap-1">
                        5 <i class="fa-solid fa-star text-yellow-500 text-[10px]"></i>
                    </button>
                    <button class="snap-start flex-shrink-0 px-4 py-2 bg-white hover:bg-gray-50 border border-gray-200 text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition flex items-center gap-1">
                        4 <i class="fa-solid fa-star text-yellow-500 text-[10px]"></i>
                    </button>
                    <button class="snap-start flex-shrink-0 px-4 py-2 bg-white hover:bg-gray-50 border border-gray-200 text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition flex items-center gap-1">
                        3 <i class="fa-solid fa-star text-yellow-500 text-[10px]"></i>
                    </button>
                    <button class="snap-start flex-shrink-0 px-4 py-2 bg-white hover:bg-gray-50 border border-gray-200 text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition flex items-center gap-1">
                        2 <i class="fa-solid fa-star text-yellow-500 text-[10px]"></i>
                    </button>
                    <button class="snap-start flex-shrink-0 px-4 py-2 bg-white hover:bg-gray-50 border border-gray-200 text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition flex items-center gap-1">
                        1 <i class="fa-solid fa-star text-yellow-500 text-[10px]"></i>
                    </button>
                </div>

                <div class="flex flex-col gap-4">
                    
                    @forelse ($reviews as $review)
                    <div class="bg-[#FFFDFB] border border-[#F0EBE1] rounded-2xl p-5 md:p-6 shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="font-bold text-brand-dark text-base md:text-lg">{{ $review->user->name }}</h4>
                            <div class="flex text-yellow-400 text-xs md:text-sm">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $review->rating)
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p class="italic text-gray-600 text-sm md:text-base mb-4 leading-relaxed font-serif">
                            "{{ $review->comment }}"
                        </p>
                        <p class="text-[11px] md:text-xs text-[#B08D6A] font-medium tracking-wide">{{ $review->created_at->format('Y-m-d') }}</p>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-sm">Belum ada ulasan untuk produk ini. Jadilah yang pertama memberikan ulasan!</p>
                    </div>
                    @endforelse

                </div>

                @if ($reviews->hasPages())
                <div class="mt-8 text-center">
                    {{ $reviews->links() }}
                </div>
                @endif
            </section>

        </div>
    </div>

    {{-- SCRIPT UNTUK FORM TOGGLE & STAR RATING --}}
    @if(Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'user')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnTulis = document.getElementById('btn-tulis-ulasan');
            const btnBatal = document.getElementById('btn-batal-ulasan');
            const formContainer = document.getElementById('form-ulasan-container');

            if (btnTulis && btnBatal && formContainer) {
                // Logika untuk Muncul/Sembunyi Form
                btnTulis.addEventListener('click', function () {
                    formContainer.classList.remove('hidden');
                    btnTulis.classList.add('hidden'); // Sembunyikan tombol 'Tulis Ulasan'
                });

                btnBatal.addEventListener('click', function () {
                    formContainer.classList.add('hidden');
                    btnTulis.classList.remove('hidden'); // Tampilkan lagi tombolnya
                });

                // Logika untuk Rating Bintang Interaktif
                const stars = document.querySelectorAll('#star-rating i');
                const ratingInput = document.getElementById('rating-input');
                
                if (stars.length > 0 && ratingInput) {
                    stars.forEach(star => {
                        star.addEventListener('click', function () {
                            const value = this.getAttribute('data-value');
                            ratingInput.value = value; // Masukkan angka ke input hidden
                            
                            // Update visual warna bintang
                            stars.forEach(s => {
                                if (s.getAttribute('data-value') <= value) {
                                    s.classList.remove('text-gray-300');
                                    s.classList.add('text-yellow-400');
                                } else {
                                    s.classList.remove('text-yellow-400');
                                    s.classList.add('text-gray-300');
                                }
                            });
                        });
                    });
                }
            }
        });
    </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityMinus = document.querySelector('.quantity-minus');
            const quantityPlus = document.querySelector('.quantity-plus');
            const quantityDisplay = document.getElementById('quantity-display');
            const orderQuantity = document.getElementById('order-quantity');

            if (quantityMinus && quantityPlus && quantityDisplay && orderQuantity) {
                let quantity = parseInt(quantityDisplay.value, 10) || 1;

                quantityMinus.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (quantity > 1) {
                        quantity -= 1;
                        quantityDisplay.value = quantity;
                        orderQuantity.value = quantity;
                    }
                });

                quantityPlus.addEventListener('click', function (event) {
                    event.preventDefault();
                    quantity += 1;
                    quantityDisplay.value = quantity;
                    orderQuantity.value = quantity;
                });
            }
        });
    </script>
@endsection