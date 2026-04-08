@extends('layouts.app')

@section('title', 'Ananda Bakery | Cakes, Bread & More...')

@section('content')
    <section class="relative w-full h-[400px] md:h-[500px] bg-black overflow-hidden flex items-center">
        <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=2072&auto=format&fit=crop" alt="Berbagai macam roti dan pastry segar Ananda Bakery" class="absolute inset-0 w-full h-full object-cover opacity-60">
        
        <div class="container mx-auto px-6 md:px-10 relative z-10">
            <div class="max-w-xl text-white">
                <h1 class="font-heading text-4xl md:text-6xl font-bold mb-4 leading-tight">Light Up<br>Your Bite</h1>
                <p class="text-sm md:text-lg mb-8 opacity-90 leading-relaxed">Experience the authentic taste of premium patisserie, crafted with love and passion using only the finest ingredients.</p>
                <a href="/menu" class="inline-flex bg-white text-brand-dark font-semibold py-3 px-8 rounded-full hover:bg-brand-primary hover:text-white transition duration-300 items-center gap-2 text-sm md:text-base w-max">
                    Explore Menu <i class="fa-solid fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>

        <div class="absolute bottom-6 w-full flex justify-center gap-3">
            <button class="w-3 h-3 rounded-full bg-white opacity-100 shadow" aria-label="Slide 1"></button>
            <button class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition" aria-label="Slide 2"></button>
            <button class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition" aria-label="Slide 3"></button>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-brand-light">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10 md:mb-12">
                <h2 class="font-heading text-3xl md:text-4xl font-bold mb-2">Menu Terfavorit</h2>
                <div class="w-20 md:w-24 h-1 bg-brand-primary mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <article class="bg-brand-card rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 group">
                    <div class="relative h-56 md:h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1549931319-a545dcf3bc73?q=80&w=2070&auto=format&fit=crop" alt="Classic Croissant" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-4 right-4 bg-white px-2 py-1 rounded-md text-xs md:text-sm font-bold shadow flex items-center gap-1">
                            <i class="fa-solid fa-star text-yellow-500 text-xs"></i> 4.9
                        </div>
                    </div>
                    <div class="p-5 md:p-6">
                        <h3 class="font-heading text-lg md:text-xl font-bold mb-2">Classic Croissant</h3>
                        <p class="text-xs md:text-sm text-gray-600 mb-4 h-10 line-clamp-2">Buttery, flaky, and golden-brown French pastry made with premium butter.</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-brand-primary text-base md:text-lg">Rp 25.000</span>
                            <span class="bg-green-100 text-green-700 text-[10px] md:text-xs font-bold px-3 py-1 rounded-full">Tersedia</span>
                        </div>
                    </div>
                </article>

                <article class="bg-brand-card rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 group">
                    <div class="relative h-56 md:h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1576618148400-f54bed99fcfd?q=80&w=2080&auto=format&fit=crop" alt="Blueberry Cheesecake Bun" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-4 right-4 bg-white px-2 py-1 rounded-md text-xs md:text-sm font-bold shadow flex items-center gap-1">
                            <i class="fa-solid fa-star text-yellow-500 text-xs"></i> 4.9
                        </div>
                    </div>
                    <div class="p-5 md:p-6">
                        <h3 class="font-heading text-lg md:text-xl font-bold mb-2">Blueberry Cheesecake Bun</h3>
                        <p class="text-xs md:text-sm text-gray-600 mb-4 h-10 line-clamp-2">Sweet bun with creamy cheesecake filling and fresh blueberry jam.</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-brand-primary text-base md:text-lg">Rp 20.000</span>
                            <span class="bg-green-100 text-green-700 text-[10px] md:text-xs font-bold px-3 py-1 rounded-full">Tersedia</span>
                        </div>
                    </div>
                </article>

                <article class="bg-brand-card rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 group">
                    <div class="relative h-56 md:h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1608198093002-ad4e005484ec?q=80&w=2132&auto=format&fit=crop" alt="Chocolate Lava Bun" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-4 right-4 bg-white px-2 py-1 rounded-md text-xs md:text-sm font-bold shadow flex items-center gap-1">
                            <i class="fa-solid fa-star text-yellow-500 text-xs"></i> 4.8
                        </div>
                    </div>
                    <div class="p-5 md:p-6">
                        <h3 class="font-heading text-lg md:text-xl font-bold mb-2">Chocolate Lava Bun</h3>
                        <p class="text-xs md:text-sm text-gray-600 mb-4 h-10 line-clamp-2">Soft sweet bread filled with rich, melting dark chocolate ganache.</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-brand-primary text-base md:text-lg">Rp 18.000</span>
                            <span class="bg-green-100 text-green-700 text-[10px] md:text-xs font-bold px-3 py-1 rounded-full">Tersedia</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-16 bg-white border-t border-b border-gray-100">
        <div class="container mx-auto px-6 text-center">
            <h2 class="font-heading text-2xl md:text-4xl font-bold mb-2 md:mb-4">Created with love and passion</h2>
            <p class="text-sm md:text-base text-gray-500 mb-10 md:mb-12">Ananda Bakery is your favorite daily pastry & bread destination</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-brand-card p-6 md:p-8 rounded-2xl border border-brand-light shadow-sm text-left">
                    <div class="flex items-center gap-4 mb-4 md:mb-6">
                        <div class="text-yellow-400 text-2xl md:text-3xl">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div>
                            <div class="font-bold text-brand-dark text-sm md:text-base">4.9 / 5.0</div>
                            <div class="text-[10px] md:text-xs text-gray-500">Based on customer reviews</div>
                        </div>
                    </div>
                    <p class="text-xs md:text-sm text-gray-700 italic mb-4 md:mb-6">"Roti croissantnya luar biasa! Benar-benar renyah di luar dan lembut di dalam. Selalu pesan ini tiap pagi sebelum berangkat kerja."</p>
                    <div class="text-xs md:text-sm font-semibold text-brand-primary">- Sarah, Happy Customer</div>
                </div>

                <div class="bg-brand-card p-6 md:p-8 rounded-2xl border border-brand-light shadow-sm text-left">
                    <div class="flex items-center gap-4 mb-4 md:mb-6">
                        <div class="text-yellow-400 text-2xl md:text-3xl">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div>
                            <div class="font-bold text-brand-dark text-sm md:text-base">4.8 / 5.0</div>
                            <div class="text-[10px] md:text-xs text-gray-500">Based on customer reviews</div>
                        </div>
                    </div>
                    <p class="text-xs md:text-sm text-gray-700 italic mb-4 md:mb-6">"Paling suka sama Blueberry Cheesecake Bun. Rasanya pas, tidak terlalu manis dan rotinya super empuk. Sangat direkomendasikan!"</p>
                    <div class="text-xs md:text-sm font-semibold text-brand-primary">- Budi, Happy Customer</div>
                </div>

                <div class="bg-brand-card p-6 md:p-8 rounded-2xl border border-brand-light shadow-sm text-left">
                    <div class="flex items-center gap-4 mb-4 md:mb-6">
                        <div class="text-yellow-400 text-2xl md:text-3xl">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div>
                            <div class="font-bold text-brand-dark text-sm md:text-base">5.0 / 5.0</div>
                            <div class="text-[10px] md:text-xs text-gray-500">Based on customer reviews</div>
                        </div>
                    </div>
                    <p class="text-xs md:text-sm text-gray-700 italic mb-4 md:mb-6">"Layanan pesan antar sangat cepat, packaging aman, dan yang terpenting kuenya masih sangat fresh saat sampai di rumah. Mantap Ananda Bakery!"</p>
                    <div class="text-xs md:text-sm font-semibold text-brand-primary">- Citra, Happy Customer</div>
                </div>
            </div>
        </div>
    </section>
@endsection