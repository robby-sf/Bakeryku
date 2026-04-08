@extends('layouts.app')

@section('title', 'Promo | Ananda Bakery')

@push('styles')
<style>
    .hide-scroll-bar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .hide-scroll-bar::-webkit-scrollbar {
        display: none;
    }
</style>
@endpush

@section('content')

    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-6">
            
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="font-heading text-2xl md:text-4xl font-bold mb-2 text-brand-dark flex items-center gap-2">
                        <i class="fa-solid fa-fire text-red-500"></i> Promo Buy 1 Get 1
                    </h2>
                    <div class="w-16 md:w-20 h-1 bg-brand-primary rounded-full"></div>
                    <p class="text-sm text-gray-500 mt-2">Beli satu, bawa pulang dua! Khusus hari ini.</p>
                </div>
                
                <div class="hidden md:flex gap-2">
                    <button class="w-10 h-10 rounded-full bg-brand-light text-brand-dark shadow-sm hover:bg-brand-primary hover:text-white transition flex items-center justify-center">
                        <i class="fa-solid fa-chevron-left text-sm"></i>
                    </button>
                    <button class="w-10 h-10 rounded-full bg-brand-light text-brand-dark shadow-sm hover:bg-brand-primary hover:text-white transition flex items-center justify-center">
                        <i class="fa-solid fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>

            <div class="flex flex-nowrap overflow-x-auto gap-6 pb-8 snap-x snap-mandatory hide-scroll-bar">
                
                <article class="bg-brand-card rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 group min-w-[280px] md:min-w-[320px] max-w-[320px] snap-start flex-shrink-0 relative border border-gray-100">
                    <div class="absolute top-0 left-0 bg-red-500 text-white font-bold text-[10px] md:text-xs px-3 py-1.5 rounded-br-xl z-10 shadow-md flex items-center gap-1">
                        <i class="fa-solid fa-gift"></i> Buy 1 Get 1 Free
                    </div>
                    
                    <div class="relative h-48 md:h-52 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1598373182133-52452f7691ef?q=80&w=2070&auto=format&fit=crop" alt="Roti Tawar Gandum" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    
                    <div class="p-5 flex flex-col h-[220px]">
                        <h3 class="font-heading text-lg font-bold mb-1 text-brand-dark">Roti Tawar Gandum</h3>
                        <p class="text-xs text-gray-500 mb-4 flex-1">Beli 1 Roti Tawar Gandum, gratis 1 Roti Manis varian bebas (tulis di catatan).</p>
                        
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <span class="text-gray-400 text-xs line-through decoration-red-500">Rp 45.000</span>
                                <div class="font-bold text-brand-primary text-lg">Rp 25.000</div>
                            </div>
                            <span class="bg-red-50 text-red-600 text-[10px] font-bold px-2 py-1 rounded border border-red-100">Sisa 5 Paket</span>
                        </div>
                        
                        <a href="https://wa.me/6281234567890?text=Halo%20Ananda%20Bakery,%20saya%20mau%20pesan%20Promo%20Buy%201%20Get%201:%20Roti%20Tawar%20Gandum.%20Apakah%20masih%20tersedia?" target="_blank" class="w-full bg-[#25D366] text-white font-bold py-2.5 rounded-full hover:bg-[#128C7E] transition duration-300 text-sm shadow-md flex justify-center items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-lg"></i> Order Now
                        </a>
                    </div>
                </article>

                <article class="bg-brand-card rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 group min-w-[280px] md:min-w-[320px] max-w-[320px] snap-start flex-shrink-0 relative border border-gray-100">
                    <div class="absolute top-0 left-0 bg-red-500 text-white font-bold text-[10px] md:text-xs px-3 py-1.5 rounded-br-xl z-10 shadow-md flex items-center gap-1">
                        <i class="fa-solid fa-gift"></i> Buy 1 Get 1 Free
                    </div>
                    
                    <div class="relative h-48 md:h-52 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1550461716-e5b1eb5e4cd8?q=80&w=2070&auto=format&fit=crop" alt="Donat Cokelat" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    
                    <div class="p-5 flex flex-col h-[220px]">
                        <h3 class="font-heading text-lg font-bold mb-1 text-brand-dark">Donat Choco Glaze</h3>
                        <p class="text-xs text-gray-500 mb-4 flex-1">Beli 1 Box (Isi 6) Donat Choco Glaze, gratis 1 Box Donat Gula.</p>
                        
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <span class="text-gray-400 text-xs line-through decoration-red-500">Rp 70.000</span>
                                <div class="font-bold text-brand-primary text-lg">Rp 45.000</div>
                            </div>
                            <span class="bg-green-50 text-green-600 text-[10px] font-bold px-2 py-1 rounded border border-green-100">Tersedia</span>
                        </div>
                        
                        <a href="https://wa.me/6281234567890?text=Halo%20Ananda%20Bakery,%20saya%20mau%20pesan%20Promo%20Buy%201%20Get%201:%20Donat%20Choco%20Glaze.%20Apakah%20masih%20tersedia?" target="_blank" class="w-full bg-[#25D366] text-white font-bold py-2.5 rounded-full hover:bg-[#128C7E] transition duration-300 text-sm shadow-md flex justify-center items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-lg"></i> Order Now
                        </a>
                    </div>
                </article>

                <article class="bg-brand-card rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 group min-w-[280px] md:min-w-[320px] max-w-[320px] snap-start flex-shrink-0 relative border border-gray-100">
                    <div class="absolute top-0 left-0 bg-red-500 text-white font-bold text-[10px] md:text-xs px-3 py-1.5 rounded-br-xl z-10 shadow-md flex items-center gap-1">
                        <i class="fa-solid fa-gift"></i> Buy 1 Get 1 Free
                    </div>
                    
                    <div class="relative h-48 md:h-52 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1509365465985-25d11c17e812?q=80&w=1914&auto=format&fit=crop" alt="Cinnamon Roll" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    
                    <div class="p-5 flex flex-col h-[220px]">
                        <h3 class="font-heading text-lg font-bold mb-1 text-brand-dark">Cinnamon Roll</h3>
                        <p class="text-xs text-gray-500 mb-4 flex-1">Dapatkan 2 Cinnamon Roll ukuran besar hanya dengan harga 1 pcs!</p>
                        
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <span class="text-gray-400 text-xs line-through decoration-red-500">Rp 50.000</span>
                                <div class="font-bold text-brand-primary text-lg">Rp 25.000</div>
                            </div>
                            <span class="bg-green-50 text-green-600 text-[10px] font-bold px-2 py-1 rounded border border-green-100">Tersedia</span>
                        </div>
                        
                        <a href="https://wa.me/6281234567890?text=Halo%20Ananda%20Bakery,%20saya%20mau%20pesan%20Promo%20Buy%201%20Get%201:%20Cinnamon%20Roll.%20Apakah%20masih%20tersedia?" target="_blank" class="w-full bg-[#25D366] text-white font-bold py-2.5 rounded-full hover:bg-[#128C7E] transition duration-300 text-sm shadow-md flex justify-center items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-lg"></i> Order Now
                        </a>
                    </div>
                </article>
                
                <div class="min-w-[150px] md:min-w-[200px] snap-start flex-shrink-0 flex items-center justify-center">
                    <a href="/promo" class="flex flex-col items-center justify-center text-brand-primary hover:text-brand-dark transition duration-300">
                        <div class="w-14 h-14 rounded-full bg-brand-light flex items-center justify-center mb-3 shadow-sm border border-gray-200">
                            <i class="fa-solid fa-arrow-right text-xl"></i>
                        </div>
                        <span class="font-heading font-bold text-sm text-center">Lihat Semua<br>Promo</span>
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection