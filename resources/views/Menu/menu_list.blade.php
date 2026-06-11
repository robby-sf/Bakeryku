@extends('layouts.app')

@section('title', 'Our Menu | Ananda Bakery')

@section('content')
    <div class="py-8 md:py-12">
        <div class="container mx-auto px-4 md:px-6">
            
            <div class="mb-8 md:mb-10 scroll-reveal">
                <h1 class="font-heading text-3xl md:text-4xl font-bold mb-4 md:mb-6 text-brand-dark">Our Menu</h1>
                
                <div class="relative max-w-full mb-6 group/search">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors duration-300">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 group-focus-within/search:text-brand-primary transition-colors duration-300"></i>
                    </div>
                    <input type="text" id="menuSearch"
                        class="w-full pl-11 pr-12 py-3 md:py-4 bg-[#FCF9F5] border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary transition-all duration-300 text-sm md:text-base" 
                        placeholder="Search products...">
                    <button id="clearSearch" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-brand-primary transition-colors duration-300 opacity-0 pointer-events-none" aria-label="Clear search">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="flex items-center gap-2 md:gap-3 overflow-x-auto pb-4 hide-scroll-bar snap-x" id="menu-category-list">
                    <i class="fa-solid fa-filter text-gray-400 mr-1 md:mr-2 flex-shrink-0"></i>
                    <button data-category="all" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-brand-primary text-white text-xs md:text-sm font-medium rounded-full whitespace-nowrap shadow-sm transition-all duration-300 hover:shadow-md active:scale-95">
                        All
                    </button>
                    <button data-category="pastry" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition-all duration-300 active:scale-95">
                        Pastry
                    </button>
                    <button data-category="cakes" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition-all duration-300 active:scale-95">
                        Cakes
                    </button>
                    <button data-category="chocolate" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition-all duration-300 active:scale-95">
                        Chocolate
                    </button>
                    <button data-category="bread" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition-all duration-300 active:scale-95">
                        Bread
                    </button>
                    <button data-category="assorted" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition-all duration-300 active:scale-95">
                        Assorted
                    </button>
                </div>

                {{-- Active filter indicator --}}
                <div id="filterInfo" class="hidden items-center gap-2 mt-2 text-xs text-gray-400">
                    <span>Menampilkan <strong id="visibleCount" class="text-brand-primary">0</strong> produk</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8" id="products-grid">
                
                @forelse ($products as $index => $product)
                    <article data-product-category="{{ strtolower($product->category ?? 'unknown') }}" 
                             data-product-name="{{ strtolower($product->name) }}"
                             class="product-item bg-brand-card rounded-2xl overflow-hidden shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:shadow-xl transition-all duration-400 ease-[cubic-bezier(0.4,0,0.2,1)] border border-gray-100 flex flex-col h-full group hover:-translate-y-1.5 scroll-reveal stagger-{{ min($index + 1, 6) }}">
                        <a href="{{ route('menu_view', $product->id) }}" class="flex flex-col h-full">
                            <div class="relative h-48 md:h-56 overflow-hidden bg-gray-200">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out" loading="lazy">
                                @else
                                    <img src="https://images.unsplash.com/photo-1549931319-a545dcf3bc73?q=80&w=600&auto=format&fit=crop" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out" loading="lazy">
                                @endif
                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-md text-xs md:text-sm font-bold shadow flex items-center gap-1 transition-transform duration-300 group-hover:scale-110">
                                    <i class="fa-solid fa-star text-yellow-500 text-[10px] md:text-xs"></i> {{ number_format($product->averageRating(), 1) }}
                                </div>
                                {{-- Category pill on hover --}}
                                <div class="absolute bottom-3 left-3 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                    <span class="bg-brand-primary/90 text-white text-[9px] md:text-[10px] font-semibold px-2.5 py-1 rounded-full backdrop-blur-sm uppercase tracking-wider">
                                        {{ $product->category }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-4 md:p-5 flex flex-col flex-grow">
                                <h3 class="font-heading text-base md:text-lg font-bold mb-1 md:mb-2 text-brand-dark group-hover:text-brand-primary transition-colors duration-300">{{ $product->name }}</h3>
                                <p class="text-xs text-gray-600 mb-4 flex-grow line-clamp-2">{{ $product->description ?? 'Produk berkualitas premium dari Slice Bread Bakery' }}</p>
                                <div class="flex justify-between items-center mt-auto">
                                    <span class="font-bold text-brand-primary text-sm md:text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="bg-green-100 text-green-700 text-[9px] md:text-[10px] uppercase tracking-wider font-bold px-2 py-1 rounded-full">{{ $product->status }}</span>
                                </div>
                            </div>
                        </a>
                    </article>
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-lg font-bold text-[#452A1B]">Belum ada produk saat ini</p>
                    </div>
                @endforelse

                <div id="no-category-results" class="col-span-full text-center py-16 hidden">
                    <div class="inline-flex flex-col items-center gap-3">
                        <i class="fa-solid fa-face-sad-tear text-4xl text-gray-300"></i>
                        <p class="text-lg font-bold text-[#452A1B]">Belum ada produk pada kategori ini</p>
                        <p class="text-sm text-gray-400">Coba pilih kategori lain</p>
                    </div>
                </div>

                <div id="no-search-results" class="col-span-full text-center py-16 hidden">
                    <div class="inline-flex flex-col items-center gap-3">
                        <i class="fa-solid fa-magnifying-glass text-4xl text-gray-300"></i>
                        <p class="text-lg font-bold text-[#452A1B]">Produk tidak ditemukan</p>
                        <p class="text-sm text-gray-400">Coba kata kunci lain</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-10 md:mt-12 text-center scroll-reveal">
                <a href="#" id="scrollTopBtn" class="inline-flex items-center gap-2 border-2 border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-white font-semibold py-3 md:py-2 px-8 rounded-full transition-all duration-300 text-sm md:text-base active:scale-95">
                    <i class="fa-solid fa-arrow-up text-xs"></i> Kembali ke Atas
                </a>
            </div>
            
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.category-filter');
            const products = document.querySelectorAll('.product-item');
            const searchInput = document.getElementById('menuSearch');
            const clearBtn = document.getElementById('clearSearch');
            const filterInfo = document.getElementById('filterInfo');
            const visibleCountEl = document.getElementById('visibleCount');
            const noCategoryResults = document.getElementById('no-category-results');
            const noSearchResults = document.getElementById('no-search-results');
            const scrollTopBtn = document.getElementById('scrollTopBtn');

            let activeCategory = 'all';

            const categoryMap = {
                pastry: ['pastry'],
                bread: ['roti manis', 'roti asin', 'bread'],
                cakes: ['cakes'],
                chocolate: ['chocolate'],
                assorted: ['assorted'],
            };

            function setActiveButton(activeButton) {
                buttons.forEach(btn => {
                    if (btn === activeButton) {
                        btn.classList.remove('bg-[#EBE3D5]', 'text-brand-dark', 'hover:bg-[#dfd7c9]');
                        btn.classList.add('bg-brand-primary', 'text-white');
                    } else {
                        btn.classList.add('bg-[#EBE3D5]', 'text-brand-dark', 'hover:bg-[#dfd7c9]');
                        btn.classList.remove('bg-brand-primary', 'text-white');
                    }
                });
            }

            function filterAndSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const mappedCategories = categoryMap[activeCategory] || [];
                let visibleCount = 0;

                products.forEach((product, i) => {
                    const cat = product.dataset.productCategory?.toLowerCase() || 'unknown';
                    const name = product.dataset.productName || '';
                    const matchCategory = activeCategory === 'all' || mappedCategories.includes(cat);
                    const matchSearch = !searchTerm || name.includes(searchTerm);

                    if (matchCategory && matchSearch) {
                        product.style.display = '';
                        product.style.opacity = '0';
                        product.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            product.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                            product.style.opacity = '1';
                            product.style.transform = 'translateY(0)';
                        }, visibleCount * 60);
                        visibleCount++;
                    } else {
                        product.style.display = 'none';
                    }
                });

                // Update counter
                visibleCountEl.textContent = visibleCount;
                filterInfo.classList.toggle('hidden', visibleCount === products.length && !searchTerm);
                filterInfo.classList.toggle('flex', visibleCount < products.length || searchTerm);

                // Show/hide empty states
                noCategoryResults.classList.toggle('hidden', visibleCount > 0 || searchTerm);
                noSearchResults.classList.toggle('hidden', visibleCount > 0 || !searchTerm);

                // Clear button visibility
                clearBtn.style.opacity = searchTerm ? '1' : '0';
                clearBtn.style.pointerEvents = searchTerm ? 'auto' : 'none';
            }

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    activeCategory = this.dataset.category.toLowerCase();
                    setActiveButton(this);
                    filterAndSearch();
                });
            });

            searchInput.addEventListener('input', filterAndSearch);

            clearBtn.addEventListener('click', () => {
                searchInput.value = '';
                filterAndSearch();
                searchInput.focus();
            });

            scrollTopBtn.addEventListener('click', (e) => {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Initialize
            const initialButton = document.querySelector('.category-filter[data-category="all"]');
            if (initialButton) {
                setActiveButton(initialButton);
                filterAndSearch();
            }

            // Scroll reveal
            const scrollEls = document.querySelectorAll('.scroll-reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
            scrollEls.forEach(el => observer.observe(el));
        });
    </script>
@endsection