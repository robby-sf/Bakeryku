@extends('layouts.app')

@section('title', 'Promo Spesial | Slice Bread Bakery')

@section('content')

    {{-- Hero Banner --}}
    <section class="relative py-20 md:py-28 text-white overflow-hidden bg-gradient-to-br from-brand-dark via-brand-primary to-[#C4835C]">
        {{-- Animated orbs --}}
        <div class="absolute top-[-20%] right-[-10%] w-[400px] h-[400px] bg-white/[0.06] rounded-full blur-3xl animate-[float_8s_ease-in-out_infinite]"></div>
        <div class="absolute bottom-[-15%] left-[-5%] w-[300px] h-[300px] bg-white/[0.04] rounded-full blur-2xl animate-[float_6s_ease-in-out_infinite_1s]"></div>

        <div class="container mx-auto px-6 text-center relative z-10">
            <div class="scroll-reveal">
                <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm px-4 py-1.5 rounded-full mb-6">
                    <i class="fa-solid fa-sparkles text-amber-300 text-xs"></i>
                    <span class="text-xs font-semibold uppercase tracking-[0.2em] text-white/90 font-promo">Penawaran Spesial</span>
                </div>
            </div>
            <h1 class="scroll-reveal font-promo text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">Promo Kami</h1>
            <p class="scroll-reveal text-white/80 max-w-lg mx-auto text-sm md:text-base leading-relaxed font-promo">
                Nikmati berbagai penawaran menarik dari Slice Bread Bakery. 
                Jangan lewatkan kesempatan untuk mendapatkan produk favorit dengan harga spesial!
            </p>
            <div class="flex justify-center mt-6 scroll-reveal">
                <div class="flex items-center gap-3 text-white/60 text-xs">
                    <span class="w-8 h-px bg-white/30"></span>
                    <i class="fa-solid fa-wheat-awn text-amber-300/70"></i>
                    <span class="w-8 h-px bg-white/30"></span>
                </div>
            </div>
        </div>
    </section>

    {{-- Promo Cards Section --}}
    <section class="py-12 md:py-20 bg-brand-light">
        <div class="container mx-auto px-6">
            
            {{-- Section Header --}}
            <div class="text-center mb-12 scroll-reveal">
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-brand-primary/70 font-promo">Berlaku Terbatas</span>
                <h2 class="font-promo text-2xl md:text-4xl font-bold text-brand-dark mt-2 mb-3">
                    Promo Sedang Berjalan
                </h2>
                <div class="flex items-center justify-center gap-3 mb-4">
                    <span class="w-12 h-px bg-gradient-to-r from-transparent via-brand-primary to-transparent"></span>
                    <i class="fa-solid fa-fire text-red-400 text-sm"></i>
                    <span class="w-12 h-px bg-gradient-to-r from-transparent via-brand-primary to-transparent"></span>
                </div>
                <p class="text-sm text-gray-500 max-w-md mx-auto font-promo">Buruan manfaatkan sebelum masa berlaku habis!</p>
            </div>

            {{-- Promo Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @include('promo._promo_cards', ['promos' => $promos, 'waNumber' => $waNumber])
            </div>

        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-white scroll-reveal">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto bg-gradient-to-br from-brand-dark to-brand-primary rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden group">
                {{-- Decorative orbs --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <i class="fa-solid fa-bell text-amber-300 text-2xl mb-4 animate-[float_3s_ease-in-out_infinite]"></i>
                    <h3 class="font-promo text-2xl md:text-3xl font-bold mb-3">Jangan Lewatkan Promo!</h3>
                    <p class="text-white/70 text-sm md:text-base mb-6 max-w-md mx-auto font-promo">
                        Kunjungi halaman ini secara berkala atau hubungi kami via WhatsApp untuk info promo terbaru.
                    </p>
                    @php
                        $normalizedWa = preg_replace('/\D+/', '', $waNumber ?? '+62 856 0238 5989');
                        $ctaMessage = rawurlencode('Halo Slice Bread Bakery, saya mau tanya info promo terbaru dong!');
                    @endphp
                    <a href="https://wa.me/{{ $normalizedWa }}?text={{ $ctaMessage }}" target="_blank"
                       class="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#128C7E] text-white font-bold py-3 px-8 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95 group/btn font-promo">
                        <i class="fa-brands fa-whatsapp text-xl group-hover/btn:rotate-12 transition-transform duration-300"></i>
                        Tanya Promo via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll reveal
    const els = document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-scale');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
    els.forEach(el => observer.observe(el));

    // Stagger promo cards
    const promoCards = document.querySelectorAll('.promo-card');
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, i * 120);
                cardObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    promoCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s cubic-bezier(0.4,0,0.2,1), transform 0.6s cubic-bezier(0.4,0,0.2,1)';
        cardObserver.observe(card);
    });
});
</script>
@endsection
