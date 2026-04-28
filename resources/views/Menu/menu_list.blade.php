@extends('layouts.app')

@section('title', 'Our Menu | Ananda Bakery')

@section('content')
    <div class="py-8 md:py-12">
        <div class="container mx-auto px-4 md:px-6">
            
            <div class="mb-8 md:mb-10">
                <h1 class="font-heading text-3xl md:text-4xl font-bold mb-4 md:mb-6 text-brand-dark">Our Menu</h1>
                
                <div class="relative max-w-full mb-6">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </div>
                    <input type="text" class="w-full pl-11 pr-4 py-3 md:py-4 bg-[#FCF9F5] border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-primary focus:border-brand-primary transition text-sm md:text-base" placeholder="Search products...">
                </div>

                <div class="flex items-center gap-2 md:gap-3 overflow-x-auto pb-4 scrollbar-hide snap-x" id="menu-category-list">
                    <i class="fa-solid fa-filter text-gray-400 mr-1 md:mr-2 flex-shrink-0"></i>
                    <button data-category="all" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-brand-primary text-white text-xs md:text-sm font-medium rounded-full whitespace-nowrap shadow-sm">
                        All
                    </button>
                    <button data-category="pastry" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition">
                        Pastry
                    </button>
                    <button data-category="cakes" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition">
                        Cakes
                    </button>
                    <button data-category="chocolate" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition">
                        Chocolate
                    </button>
                    <button data-category="bread" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition">
                        Bread
                    </button>
                    <button data-category="assorted" class="category-filter snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition">
                        Assorted
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8" id="products-grid">
                
                @forelse ($products as $product)
                    <article data-product-category="{{ strtolower($product->category ?? 'unknown') }}" class="bg-brand-card rounded-2xl overflow-hidden shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:shadow-xl transition duration-300 border border-gray-100 flex flex-col h-full group">
                        <a href="{{ route('menu_view', $product->id) }}" class="flex flex-col h-full">
                            <div class="relative h-48 md:h-56 overflow-hidden bg-gray-200">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <img src="https://images.unsplash.com/photo-1549931319-a545dcf3bc73?q=80&w=600&auto=format&fit=crop" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @endif
                                <div class="absolute top-3 right-3 bg-white px-2 py-1 rounded-md text-xs md:text-sm font-bold shadow flex items-center gap-1">
                                    <i class="fa-solid fa-star text-yellow-500 text-[10px] md:text-xs"></i> {{ number_format($product->averageRating(), 1) }}
                                </div>
                            </div>
                            <div class="p-4 md:p-5 flex flex-col flex-grow">
                                <h3 class="font-heading text-base md:text-lg font-bold mb-1 md:mb-2 text-brand-dark group-hover:text-brand-primary transition">{{ $product->name }}</h3>
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
                    <p class="text-lg font-bold text-[#452A1B]">Belum ada produk pada kategori ini</p>
                </div>
            </div>
            
            <div class="mt-10 md:mt-12 text-center">
                <button class="w-full md:w-auto border-2 border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-white font-semibold py-3 md:py-2 px-8 rounded-full transition duration-300 text-sm md:text-base">
                    Load More
                </button>
            </div>
            
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.category-filter');
            const products = document.querySelectorAll('[data-product-category]');
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

            function filterProducts(category) {
                const mappedCategories = categoryMap[category] || [];
                products.forEach(product => {
                    const productCategory = product.dataset.productCategory?.toLowerCase() || 'unknown';
                    if (category === 'all' || mappedCategories.includes(productCategory)) {
                        product.style.display = '';
                    } else {
                        product.style.display = 'none';
                    }
                });
            }

            const noResults = document.getElementById('no-category-results');

            function updateEmptyMessage() {
                const visibleCount = Array.from(products).filter(product => product.style.display !== 'none').length;
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            }

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const category = this.dataset.category.toLowerCase();
                    setActiveButton(this);
                    filterProducts(category);
                    updateEmptyMessage();
                });
            });

            // Initialize with All selected
            const initialButton = document.querySelector('.category-filter[data-category="all"]');
            if (initialButton) {
                setActiveButton(initialButton);
                filterProducts('all');
                updateEmptyMessage();
            }
        });
    </script>
@endsection