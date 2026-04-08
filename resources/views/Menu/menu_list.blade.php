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

                <div class="flex items-center gap-2 md:gap-3 overflow-x-auto pb-4 scrollbar-hide snap-x">
                    <i class="fa-solid fa-filter text-gray-400 mr-1 md:mr-2 flex-shrink-0"></i>
                    <button class="snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-brand-primary text-white text-xs md:text-sm font-medium rounded-full whitespace-nowrap shadow-sm">
                        All
                    </button>
                    <button class="snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition">
                        Pastry
                    </button>
                    <button class="snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition">
                        Cakes
                    </button>
                    <button class="snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition">
                        Chocolate
                    </button>
                    <button class="snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition">
                        Bread
                    </button>
                    <button class="snap-start flex-shrink-0 px-4 md:px-5 py-2 bg-[#EBE3D5] hover:bg-[#dfd7c9] text-brand-dark text-xs md:text-sm font-medium rounded-full whitespace-nowrap transition">
                        Assorted
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                
                @php
                    $dummyProducts = [
                        ['name' => 'Classic Croissant', 'price' => 'Rp 25.000', 'rating' => '4.9', 'img' => 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?q=80&w=600&auto=format&fit=crop', 'desc' => 'Buttery, flaky, and golden-brown French pastry made with premium butter.'],
                        ['name' => 'Blueberry Cheese Bun', 'price' => 'Rp 20.000', 'rating' => '4.9', 'img' => 'https://images.unsplash.com/photo-1576618148400-f54bed99fcfd?q=80&w=600&auto=format&fit=crop', 'desc' => 'Sweet bun with creamy cheesecake filling and fresh blueberry jam.'],
                        ['name' => 'Chocolate Lava Bun', 'price' => 'Rp 18.000', 'rating' => '4.8', 'img' => 'https://images.unsplash.com/photo-1608198093002-ad4e005484ec?q=80&w=600&auto=format&fit=crop', 'desc' => 'Soft sweet bread filled with rich, melting dark chocolate ganache.'],
                        ['name' => 'Smoked Beef & Cheese', 'price' => 'Rp 22.000', 'rating' => '4.7', 'img' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=600&auto=format&fit=crop', 'desc' => 'Savory bread loaded with premium smoked beef and cheddar cheese.'],
                        ['name' => 'Almond Danish', 'price' => 'Rp 28.000', 'rating' => '4.6', 'img' => 'https://images.unsplash.com/photo-1621236378699-8597faf6a176?q=80&w=600&auto=format&fit=crop', 'desc' => 'Flaky pastry filled with sweet almond paste and topped with sliced almonds.'],
                        ['name' => 'Strawberry Tart', 'price' => 'Rp 35.000', 'rating' => '5.0', 'img' => 'https://images.unsplash.com/photo-1519869325930-281384150729?q=80&w=600&auto=format&fit=crop', 'desc' => 'Crispy tart shell filled with vanilla custard and fresh strawberries.']
                    ];
                @endphp

                @for ($i = 0; $i < 5; $i++)
                    @foreach ($dummyProducts as $product)
                        <article class="bg-brand-card rounded-2xl overflow-hidden shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:shadow-xl transition duration-300 border border-gray-100 flex flex-col h-full group">
                            <a href="/menu/view" class="flex flex-col h-full">
                                <div class="relative h-48 md:h-56 overflow-hidden bg-gray-200">
                                    <img src="{{ $product['img'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <div class="absolute top-3 right-3 bg-white px-2 py-1 rounded-md text-xs md:text-sm font-bold shadow flex items-center gap-1">
                                        <i class="fa-solid fa-star text-yellow-500 text-[10px] md:text-xs"></i> {{ $product['rating'] }}
                                    </div>
                                </div>
                                <div class="p-4 md:p-5 flex flex-col flex-grow">
                                    <h3 class="font-heading text-base md:text-lg font-bold mb-1 md:mb-2 text-brand-dark group-hover:text-brand-primary transition">{{ $product['name'] }}</h3>
                                    <p class="text-xs text-gray-600 mb-4 flex-grow line-clamp-2">{{ $product['desc'] }}</p>
                                    <div class="flex justify-between items-center mt-auto">
                                        <span class="font-bold text-brand-primary text-sm md:text-base">{{ $product['price'] }}</span>
                                        <span class="bg-green-100 text-green-700 text-[9px] md:text-[10px] uppercase tracking-wider font-bold px-2 py-1 rounded-full">Tersedia</span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                @endfor

            </div>
            
            <div class="mt-10 md:mt-12 text-center">
                <button class="w-full md:w-auto border-2 border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-white font-semibold py-3 md:py-2 px-8 rounded-full transition duration-300 text-sm md:text-base">
                    Load More
                </button>
            </div>
            
        </div>
    </div>
@endsection