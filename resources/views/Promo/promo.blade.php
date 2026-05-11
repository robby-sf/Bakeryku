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
                @include('Promo._promo_cards', ['promos' => $promos, 'waNumber' => $waNumber])
                
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
