@extends('layouts.app')

@section('title', 'Special Bundle Deal | Ananda Bakery')

@section('content')
    <div class="py-8 md:py-12">
        <div class="container mx-auto px-4 md:px-6 max-w-5xl">
            
            <a href="/menu" class="inline-flex items-center gap-2 text-brand-primary hover:text-brand-dark transition font-medium mb-6 md:mb-8 text-sm md:text-base">
                <i class="fa-solid fa-arrow-left"></i> Back to Catalog
            </a>

            <div class="flex flex-col md:flex-row gap-8 lg:gap-12 mb-16 md:mb-24">
                
                <div class="w-full md:w-1/2 flex flex-col gap-4">
                    <div class="bg-[#EAE4D9] rounded-2xl aspect-square flex items-center justify-center p-8 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?q=80&w=800&auto=format&fit=crop" alt="Special Bundle Deal" class="w-full h-full object-cover rounded-xl mix-blend-multiply opacity-90 hover:scale-105 transition duration-500">
                    </div>
                    <div class="flex gap-4">
                        <button class="w-20 h-20 bg-[#EAE4D9] rounded-xl overflow-hidden border-2 border-brand-primary p-1">
                            <img src="https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover rounded-lg mix-blend-multiply" alt="Thumb 1">
                        </button>
                        <button class="w-20 h-20 bg-[#EAE4D9] rounded-xl overflow-hidden border-2 border-transparent hover:border-brand-primary transition p-1 opacity-70 hover:opacity-100">
                            <img src="https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover rounded-lg mix-blend-multiply" alt="Thumb 2">
                        </button>
                        <button class="w-20 h-20 bg-[#EAE4D9] rounded-xl overflow-hidden border-2 border-transparent hover:border-brand-primary transition p-1 opacity-70 hover:opacity-100">
                            <img src="https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover rounded-lg mix-blend-multiply" alt="Thumb 3">
                        </button>
                    </div>
                </div>

                <div class="w-full md:w-1/2 flex flex-col justify-start pt-2">
                    
                    <div class="mb-3">
                        <span class="bg-[#C28C62] text-white text-[10px] md:text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wide">Pastry & Drink</span>
                    </div>
                    
                    <h1 class="font-heading text-3xl md:text-4xl font-bold text-brand-dark mb-2">Special Bundle Deal</h1>
                    <div class="flex items-center gap-2 mb-6">
                        <span class="font-bold text-brand-dark text-lg">4.9</span>
                        <div class="flex text-yellow-400 text-sm">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star-half-stroke"></i>
                        </div>
                        <span class="text-sm text-gray-500 ml-1">(234 reviews)</span>
                    </div>

                    <hr class="border-gray-200 mb-6">

                    <div class="mb-6">
                        <div class="font-bold text-brand-primary text-3xl md:text-4xl mb-2">Rp 89.000</div>
                        <div class="flex items-center gap-2 text-green-600 font-medium text-sm">
                            <i class="fa-solid fa-check"></i> In Stock
                        </div>
                    </div>

                    <hr class="border-gray-200 mb-6">

                    <div class="mb-8">
                        <h3 class="font-bold text-brand-dark mb-2 text-sm md:text-base">Description</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            This exquisite special bundle deal is crafted with premium European ingredients and traditional French patisserie techniques. Each piece is carefully prepared to ensure the finest taste and quality for our valued customers.
                        </p>
                    </div>

                    <div class="flex flex-col gap-6 mt-auto">
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-brand-dark text-sm">Quantity:</span>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden w-32 bg-white">
                                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 transition"><i class="fa-solid fa-minus text-xs"></i></button>
                                <input type="text" value="1" class="w-full text-center py-2 font-semibold text-brand-dark focus:outline-none" readonly>
                                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 transition"><i class="fa-solid fa-plus text-xs"></i></button>
                            </div>
                        </div>

                        <div class="flex flex-wrap md:flex-nowrap gap-3">
                            <button class="flex-grow bg-[#8C5230] hover:bg-[#683b21] text-white font-semibold py-3 px-6 rounded-xl transition duration-300 shadow-md flex justify-center items-center gap-2 text-sm md:text-base">
                                Order via WhatsApp
                            </button>
                            <button class="w-12 h-12 md:w-14 md:h-14 flex justify-center items-center border border-gray-300 rounded-xl text-gray-500 hover:text-red-500 hover:border-red-500 transition bg-white shadow-sm flex-shrink-0">
                                <i class="fa-regular fa-heart text-lg md:text-xl"></i>
                            </button>
                            <button class="w-12 h-12 md:w-14 md:h-14 flex justify-center items-center border border-gray-300 rounded-xl text-gray-500 hover:text-brand-primary hover:border-brand-primary transition bg-white shadow-sm flex-shrink-0">
                                <i class="fa-solid fa-share-nodes text-lg md:text-xl"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <section class="border-t border-gray-200 pt-10 md:pt-12">
                
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

                    <button id="btn-tulis-ulasan" class="bg-white border-2 border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-white font-semibold py-2 md:py-3 px-6 rounded-full transition duration-300 w-full md:w-auto text-sm md:text-base cursor-pointer flex justify-center items-center">
                        <i class="fa-solid fa-pen mr-2"></i> Tulis Ulasan
                    </button>
                </div>

                <div id="form-ulasan-container" class="hidden bg-[#FFFDFB] border border-[#F0EBE1] rounded-2xl p-6 md:p-8 shadow-sm mb-8 transform transition-all">
                    <h3 class="font-bold text-brand-dark mb-1 text-lg">Bagaimana penilaian Anda?</h3>
                    <p class="text-sm text-gray-500 mb-6">Ulasan Anda membantu kami meningkatkan kualitas produk.</p>
                    
                    <form action="#" method="POST">
                        @csrf
                        
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
                            <textarea id="komentar" name="komentar" rows="4" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#C28C62] focus:ring-1 focus:ring-[#C28C62] outline-none transition bg-white text-sm" 
                                placeholder="Ceritakan pengalaman Anda (rasa, tekstur, pelayanan, dll)..."></textarea>
                        </div>

                        <div class="flex justify-end gap-3">
                            <button type="button" id="btn-batal-ulasan" class="px-6 py-2.5 rounded-xl text-sm font-bold text-gray-500 hover:bg-gray-100 transition-colors">Batal</button>
                            <button type="submit" class="bg-[#8C5230] hover:bg-[#683b21] text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-colors">Kirim Ulasan</button>
                        </div>
                    </form>
                </div>

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
                    
                    <div class="bg-[#FFFDFB] border border-[#F0EBE1] rounded-2xl p-5 md:p-6 shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="font-bold text-brand-dark text-base md:text-lg">Alice Johnson</h4>
                            <div class="flex text-yellow-400 text-xs md:text-sm">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <p class="italic text-gray-600 text-sm md:text-base mb-4 leading-relaxed font-serif">
                            "The best croissant I have ever had! So flaky and buttery."
                        </p>
                        <p class="text-[11px] md:text-xs text-[#B08D6A] font-medium tracking-wide">2024-03-20</p>
                    </div>

                    <div class="bg-[#FFFDFB] border border-[#F0EBE1] rounded-2xl p-5 md:p-6 shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="font-bold text-brand-dark text-base md:text-lg">Charlie Brown</h4>
                            <div class="flex text-yellow-400 text-xs md:text-sm">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <p class="italic text-gray-600 text-sm md:text-base mb-4 leading-relaxed font-serif">
                            "Perfect breakfast with coffee."
                        </p>
                        <p class="text-[11px] md:text-xs text-[#B08D6A] font-medium tracking-wide">2024-03-15</p>
                    </div>

                </div>

                <div class="mt-8 text-center">
                    <button class="text-brand-primary font-semibold hover:underline text-sm md:text-base">
                        Muat Lebih Banyak <i class="fa-solid fa-angle-down ml-1"></i>
                    </button>
                </div>
            </section>

        </div>
    </div>

    {{-- SCRIPT UNTUK FORM TOGGLE & STAR RATING --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnTulis = document.getElementById('btn-tulis-ulasan');
            const btnBatal = document.getElementById('btn-batal-ulasan');
            const formContainer = document.getElementById('form-ulasan-container');

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
        });
    </script>
@endsection