@extends('layouts.app')

@section('title', 'Our Store | Ananda Bakery')

@section('content')
    <div class="py-12 md:py-20 bg-brand-light">
        <div class="container mx-auto px-4 md:px-6 max-w-6xl">
            
            <div class="text-center mb-10 md:mb-16">
                <span class="text-brand-primary font-bold tracking-widest uppercase text-xs md:text-sm mb-2 block">Lokasi Toko</span>
                <h1 class="font-heading text-4xl md:text-5xl font-bold text-brand-dark mb-4">Slice Bread Bakery</h1>
                <div class="w-24 h-1 bg-brand-primary mx-auto rounded-full"></div>
            </div>

            <div class="bg-white rounded-3xl overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col lg:flex-row min-h-[550px] group">
                
                <div class="w-full lg:w-1/2 flex flex-col">
                    <div class="h-64 sm:h-80 lg:h-72 overflow-hidden relative bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=1200&auto=format&fit=crop" alt="Slice Bread Bakery Produk" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        <div class="absolute top-4 left-4 bg-brand-primary text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-md">
                            Flagship Store
                        </div>
                    </div>
                    
                    <div class="p-6 md:p-10 flex flex-col justify-center flex-grow">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-bold text-brand-dark text-lg leading-none">5,0</span>
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <span class="text-xs text-gray-400 font-medium ml-1">(5 ulasan)</span>
                        </div>
                        <h2 class="font-heading text-2xl md:text-3xl font-bold text-brand-dark mb-1">Slice Bread Bakery</h2>
                        <p class="text-gray-500 text-sm mb-6">Toko Roti</p>
                        
                        <div class="space-y-5 mb-8">
                            <div class="flex items-center gap-3 text-sm text-brand-dark font-medium border-b border-gray-50 pb-4">
                                <i class="fa-solid fa-check text-green-600"></i> Bawa pulang
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-9 h-9 rounded-full bg-[#FCF9F5] flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fa-solid fa-location-dot text-brand-primary text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm leading-relaxed">Teguhan Lor, RT.07/RW.03, Sragen Wetan, Kabupaten Sragen, Jawa Tengah</p>
                                    <p class="text-gray-400 text-[11px] mt-1 uppercase tracking-tight">H29J+W9 Sragen Wetan, Sragen</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="w-9 h-9 rounded-full bg-[#FCF9F5] flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fa-solid fa-clock text-brand-primary text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm mt-1">
                                        <span class="text-green-600 font-bold">Buka</span> · Tutup pukul 21.00
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap gap-3">
                            <a href="https://www.google.com/maps/dir//Sragen+Wetan,+Sragen+Regency,+Central+Java/" target="_blank" class="bg-brand-primary hover:bg-brand-dark text-white font-semibold py-3 px-8 rounded-full transition duration-300 flex items-center gap-2 text-sm shadow-md">
                                <i class="fa-solid fa-diamond-turn-right text-xs"></i> Rute
                            </a>
                            <button class="border border-brand-primary text-brand-primary hover:bg-brand-light font-semibold py-3 px-6 rounded-full transition duration-300 flex items-center gap-2 text-sm">
                                <i class="fa-regular fa-bookmark"></i> Simpan
                            </button>
                            <button class="border border-brand-primary text-brand-primary hover:bg-brand-light font-semibold py-3 px-6 rounded-full transition duration-300 flex items-center gap-2 text-sm">
                                <i class="fa-solid fa-share-nodes"></i> Bagikan
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2 min-h-[400px] lg:min-h-full bg-gray-100 relative border-t lg:border-t-0 lg:border-l border-gray-100">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15824.234509425028!2d111.02672775!3d-7.458778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a10292723c72b%3A0x5027a761356e4c0!2sSragen%20Wetan%2C%20Kec.%20Sragen%2C%20Kabupaten%20Sragen%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1711900000000!5m2!1sid!2sid" 
                        class="absolute inset-0 w-full h-full grayscale-[0.2] contrast-[1.1]" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="mt-12 text-center text-gray-500 text-sm">
                <p>Ingin memesan lewat telepon? Hubungi kami di <span class="font-bold text-brand-primary underline">+62 812 1314 1500</span></p>
            </div>

        </div>
    </div>
@endsection