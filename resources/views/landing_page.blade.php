@extends('layouts.app')

@section('title', 'Ananda Bakery | Cakes, Bread & More...')

@section('content')
    {{-- ===== HERO SLIDER ===== --}}
    <section class="relative w-full h-[60vh] md:h-[80vh] min-h-[400px] md:min-h-[500px] max-h-[800px] overflow-hidden" id="heroSlider">
        @forelse($heroProducts as $index => $hero)
            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                <img src="{{ Storage::url($hero->image) }}" 
                     alt="{{ $hero->name }}"
                     loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                
                {{-- Gradient overlay --}}
                <div class="absolute inset-0 flex items-center bg-gradient-to-r from-brand-dark/85 via-brand-dark/50 to-black/15 z-2">
                    <div class="container mx-auto px-6 md:px-10">
                        <div class="max-w-xl text-white">
                            <span class="hero-text-enter inline-block text-[10px] md:text-xs uppercase tracking-[0.3em] font-semibold text-white/70 mb-3 md:mb-4">
                                <i class="fa-solid fa-award mr-2"></i>Customer Favorite
                            </span>
                            <h2 class="hero-text-enter hero-text-delay-1 font-heading text-4xl md:text-6xl lg:text-7xl font-bold mb-4 md:mb-6 leading-tight">
                                {{ $hero->name }}
                            </h2>
                            <p class="hero-text-enter hero-text-delay-2 text-sm md:text-lg mb-6 md:mb-8 text-white/80 leading-relaxed max-w-md">
                                {{ Str::limit($hero->description, 100) }}
                            </p>
                            <div class="hero-text-enter hero-text-delay-2 flex flex-wrap items-center gap-4">
                                <a href="{{ route('menu_view', $hero) }}" 
                                   class="inline-flex bg-white text-brand-dark font-semibold py-3 px-8 rounded-full hover:bg-brand-primary hover:text-white transition-all duration-300 items-center gap-2 text-sm md:text-base shadow-lg hover:shadow-xl">
                                    Lihat Detail <i class="fa-solid fa-arrow-right text-sm"></i>
                                </a>
                                <span class="text-white/90 font-heading font-bold text-xl md:text-2xl">
                                    Rp {{ number_format($hero->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Fallback --}}
            <div class="hero-slide active">
                <div class="w-full h-full bg-gradient-to-br from-brand-dark to-brand-primary"></div>
                <div class="absolute inset-0 flex items-center z-2">
                    <div class="container mx-auto px-6 md:px-10">
                        <div class="max-w-xl text-white">
                            <h2 class="hero-text-enter font-heading text-4xl md:text-6xl font-bold mb-4 leading-tight">Light Up<br>Your Bite</h2>
                            <p class="hero-text-enter hero-text-delay-1 text-sm md:text-lg mb-8 opacity-90 leading-relaxed">Experience the authentic taste of premium patisserie.</p>
                            <a href="/menu" class="hero-text-enter hero-text-delay-2 inline-flex bg-white text-brand-dark font-semibold py-3 px-8 rounded-full hover:bg-brand-primary hover:text-white transition-all duration-300 items-center gap-2">
                                Explore Menu <i class="fa-solid fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse

        {{-- Hero Dots --}}
        @if($heroProducts->count() > 1)
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3 z-10">
                @foreach($heroProducts as $index => $hero)
                    <button class="hero-dot w-2.5 h-2.5 rounded-full bg-white/40 border-none cursor-pointer transition-all duration-400 p-0 {{ $index === 0 ? 'active' : '' }}" 
                            data-target="{{ $index }}" 
                            aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            {{-- Progress bar --}}
            <div class="absolute bottom-0 left-0 h-[3px] bg-gradient-to-r from-brand-primary to-[#C4835A] z-10 transition-[width] duration-100 ease-linear" id="heroProgress" style="width: 0%"></div>
        @endif
    </section>

    {{-- ===== MENU TERFAVORIT (from Database) ===== --}}
    <section class="py-16 md:py-24 bg-brand-light">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12 md:mb-16 scroll-reveal">
                <span class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-primary/70 mb-2 block">Favorit Pelanggan</span>
                <h2 class="font-heading text-3xl md:text-5xl font-bold mb-4">Menu Terfavorit</h2>
                <div class="w-15 h-[3px] bg-gradient-to-r from-brand-primary to-[#C4835A] rounded-sm mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($featuredProducts as $index => $product)
                    <article class="bg-brand-card rounded-2xl overflow-hidden shadow-lg transition-all duration-400 ease-[cubic-bezier(0.4,0,0.2,1)] hover:-translate-y-2 hover:shadow-[0_24px_48px_rgba(74,43,29,0.12)] group scroll-reveal stagger-{{ $index + 1 }}">
                        <a href="{{ route('menu_view', $product) }}" class="flex flex-col h-full">
                            <div class="relative h-56 md:h-64 overflow-hidden">
                                <img src="{{ Storage::url($product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                                     loading="lazy">
                                
                                {{-- Rating badge --}}
                                @if($product->published_reviews_avg)
                                    <div class="absolute top-4 right-4 bg-brand-card/80 backdrop-blur-xl border border-brand-primary/8 px-3 py-1.5 rounded-full text-xs md:text-sm font-bold flex items-center gap-1.5">
                                        <i class="fa-solid fa-star text-yellow-500 text-xs"></i>
                                        {{ number_format($product->published_reviews_avg, 1) }}
                                    </div>
                                @endif

                                {{-- Category badge --}}
                                <div class="absolute bottom-4 left-4">
                                    <span class="bg-brand-primary/90 text-white text-[10px] md:text-xs font-semibold px-3 py-1 rounded-full backdrop-blur-sm">
                                        {{ $product->category }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 md:p-6 flex-grow flex flex-col justify-between">
                                <div>
                                    <h3 class="font-heading text-lg md:text-xl font-bold mb-2 group-hover:text-brand-primary transition-colors duration-300">{{ $product->name }}</h3>
                                    <p class="text-xs md:text-sm text-gray-500 mb-4 h-10 line-clamp-2 leading-relaxed">{{ $product->description }}</p>
                                </div>
                                <div class="flex justify-between items-center mt-auto">
                                    <span class="font-bold text-brand-primary text-base md:text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="text-brand-primary text-xs md:text-sm font-semibold flex items-center gap-1 group-hover:gap-2 transition-all duration-300">
                                        Detail <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-400">
                        <i class="fa-solid fa-bread-slice text-4xl mb-4 block"></i>
                        <p>Menu akan segera hadir!</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-10 md:mt-14 scroll-reveal">
                <a href="/menu" class="inline-flex items-center gap-2 bg-brand-primary hover:bg-brand-dark text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 text-sm md:text-base shadow-md hover:shadow-lg group">
                    Lihat Semua Menu
                    <i class="fa-solid fa-arrow-right text-sm group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ===== PROMO SECTION (from Database) ===== --}}
    @if(isset($promos) && $promos->isNotEmpty())
        <section class="py-12 md:py-20 bg-white scroll-reveal">
            <div class="container mx-auto px-6">
                <div class="flex justify-between items-end mb-10 md:mb-14">
                    <div class="scroll-reveal-left">
                        <span class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-primary/70 font-promo">Penawaran Terbatas</span>
                        <h2 class="font-promo text-2xl md:text-4xl font-bold mt-1 mb-3 text-brand-dark">
                            Promo Spesial
                        </h2>
                        <div class="w-15 h-[3px] bg-gradient-to-r from-brand-primary to-[#C4835A] rounded-sm"></div>
                    </div>
                    <a href="/promo" class="hidden md:inline-flex items-center gap-2 text-brand-primary hover:text-brand-dark font-bold text-sm transition-all duration-300 group font-promo">
                        Lihat Semua <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @include('Promo._promo_cards', ['promos' => $promos, 'waNumber' => $waNumber])
                </div>

                <div class="mt-8 text-center md:hidden">
                    <a href="/promo" class="inline-flex items-center gap-2 bg-brand-primary hover:bg-brand-dark text-white font-bold py-2.5 px-6 rounded-full transition-all duration-300 text-sm shadow-md font-promo">
                        Lihat Semua Promo <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ===== TESTIMONIAL CAROUSEL ===== --}}
    @if(isset($reviews) && $reviews->isNotEmpty())
        <section class="py-16 md:py-24 bg-brand-light overflow-hidden" id="testimonialSection">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12 md:mb-16 scroll-reveal">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-primary/70 mb-2 block">Kata Mereka</span>
                    <h2 class="font-heading text-2xl md:text-4xl font-bold mb-3">Apa Kata Pelanggan Kami</h2>
                    <div class="w-15 h-[3px] bg-gradient-to-r from-brand-primary to-[#C4835A] rounded-sm mx-auto"></div>
                </div>

                <div class="relative max-w-6xl mx-auto scroll-reveal" id="testimonialCarousel">
                    {{-- Navigation Buttons --}}
                    <button class="absolute top-1/2 -translate-y-1/2 left-2 md:-left-5 w-11 h-11 rounded-full bg-white/90 border border-brand-primary/10 shadow-[0_4px_16px_rgba(0,0,0,0.08)] cursor-pointer flex items-center justify-center text-brand-dark hover:bg-brand-primary hover:text-white hover:shadow-[0_8px_24px_rgba(140,82,48,0.2)] transition-all duration-300 z-5" id="testimonialPrev" aria-label="Previous review">
                        <i class="fa-solid fa-chevron-left text-sm"></i>
                    </button>
                    <button class="absolute top-1/2 -translate-y-1/2 right-2 md:-right-5 w-11 h-11 rounded-full bg-white/90 border border-brand-primary/10 shadow-[0_4px_16px_rgba(0,0,0,0.08)] cursor-pointer flex items-center justify-center text-brand-dark hover:bg-brand-primary hover:text-white hover:shadow-[0_8px_24px_rgba(140,82,48,0.2)] transition-all duration-300 z-5" id="testimonialNext" aria-label="Next review">
                        <i class="fa-solid fa-chevron-right text-sm"></i>
                    </button>

                    {{-- Carousel Track --}}
                    <div class="overflow-hidden rounded-2xl">
                        <div class="testimonial-track" id="testimonialTrack">
                            @foreach($reviews as $review)
                                <div class="testimonial-card w-full md:w-1/3 shrink-0 px-3 transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]">
                                    <div class="bg-brand-card p-6 md:p-8 rounded-2xl border border-brand-primary/5 shadow-sm h-full flex flex-col">
                                        {{-- Quote icon --}}
                                        <div class="mb-4">
                                            <i class="fa-solid fa-quote-left text-2xl md:text-3xl text-transparent bg-clip-text bg-gradient-to-br from-brand-primary to-[#C4835A]"></i>
                                        </div>

                                        {{-- Stars --}}
                                        <div class="flex items-center gap-1 mb-4">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa-solid fa-star text-sm {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}"></i>
                                            @endfor
                                            <span class="ml-2 text-xs text-gray-400 font-medium">{{ $review->rating }}.0</span>
                                        </div>

                                        {{-- Comment --}}
                                        <p class="text-xs md:text-sm text-gray-600 italic leading-relaxed grow mb-6">
                                            "{{ $review->comment }}"
                                        </p>

                                        {{-- Author --}}
                                        <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                                            <div class="w-10 h-10 rounded-full bg-brand-primary/10 flex items-center justify-center shrink-0">
                                                <span class="text-brand-primary font-bold text-sm">{{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}</span>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="text-sm font-semibold text-brand-dark truncate">{{ $review->user->name ?? 'Customer' }}</div>
                                                <div class="text-[10px] md:text-xs text-brand-primary/70 truncate">{{ $review->product->name ?? '' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Dots --}}
                    <div class="flex justify-center gap-2 mt-8" id="testimonialDots"></div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===== HERO SLIDER =====
    const heroSlider = document.getElementById('heroSlider');
    if (heroSlider) {
        const slides = heroSlider.querySelectorAll('.hero-slide');
        const dots = heroSlider.querySelectorAll('.hero-dot');
        const progressBar = document.getElementById('heroProgress');
        let currentSlide = 0;
        let heroInterval = null;
        let progressInterval = null;
        const SLIDE_DURATION = 6000;
        let progressWidth = 0;

        function goToSlide(index) {
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            
            currentSlide = index;
            slides[currentSlide].classList.add('active');
            if (dots[currentSlide]) dots[currentSlide].classList.add('active');
            
            progressWidth = 0;
            if (progressBar) progressBar.style.width = '0%';
        }

        function nextSlide() {
            goToSlide((currentSlide + 1) % slides.length);
        }

        function startAutoplay() {
            stopAutoplay();
            heroInterval = setInterval(nextSlide, SLIDE_DURATION);
            progressInterval = setInterval(() => {
                progressWidth += (100 / (SLIDE_DURATION / 50));
                if (progressBar) progressBar.style.width = Math.min(progressWidth, 100) + '%';
            }, 50);
        }

        function stopAutoplay() {
            clearInterval(heroInterval);
            clearInterval(progressInterval);
        }

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                goToSlide(parseInt(dot.dataset.target));
                startAutoplay();
            });
        });

        heroSlider.addEventListener('mouseenter', stopAutoplay);
        heroSlider.addEventListener('mouseleave', startAutoplay);

        // Touch/swipe
        let touchStartX = 0;
        heroSlider.addEventListener('touchstart', e => {
            touchStartX = e.touches[0].clientX;
            stopAutoplay();
        }, { passive: true });
        heroSlider.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) nextSlide();
                else goToSlide((currentSlide - 1 + slides.length) % slides.length);
            }
            startAutoplay();
        }, { passive: true });

        if (slides.length > 1) startAutoplay();
    }

    // ===== SCROLL REVEAL =====
    const scrollElements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-scale');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    scrollElements.forEach(el => observer.observe(el));

    // ===== TESTIMONIAL CAROUSEL =====
    const testimonialTrack = document.getElementById('testimonialTrack');
    const testimonialDots = document.getElementById('testimonialDots');
    const prevBtn = document.getElementById('testimonialPrev');
    const nextBtn = document.getElementById('testimonialNext');

    if (testimonialTrack) {
        const cards = testimonialTrack.querySelectorAll('.testimonial-card');
        const totalCards = cards.length;
        let currentIndex = 0;
        let cardsPerView = getCardsPerView();
        let testimonialInterval = null;

        function getCardsPerView() {
            return window.innerWidth >= 768 ? 3 : 1;
        }

        function getTotalPages() {
            return Math.max(1, totalCards - cardsPerView + 1);
        }

        function buildDots() {
            if (!testimonialDots) return;
            testimonialDots.innerHTML = '';
            const pages = getTotalPages();
            for (let i = 0; i < pages; i++) {
                const dot = document.createElement('button');
                dot.className = 'testimonial-dot w-2 h-2 rounded-full bg-brand-primary/20 border-none cursor-pointer transition-all duration-300 p-0' + (i === 0 ? ' active' : '');
                dot.setAttribute('aria-label', 'Review page ' + (i + 1));
                dot.addEventListener('click', () => {
                    goToTestimonial(i);
                    startTestimonialAutoplay();
                });
                testimonialDots.appendChild(dot);
            }
        }

        function goToTestimonial(index) {
            const pages = getTotalPages();
            currentIndex = Math.max(0, Math.min(index, pages - 1));
            
            const cardWidth = cards[0].offsetWidth;
            testimonialTrack.style.transform = 'translateX(-' + (currentIndex * cardWidth) + 'px)';

            if (testimonialDots) {
                testimonialDots.querySelectorAll('.testimonial-dot').forEach((d, i) => {
                    d.classList.toggle('active', i === currentIndex);
                });
            }

            cards.forEach((card, i) => {
                card.classList.toggle('center-card', i === currentIndex + Math.floor(cardsPerView / 2));
            });
        }

        function nextTestimonial() {
            goToTestimonial((currentIndex + 1) % getTotalPages());
        }

        function prevTestimonial() {
            const pages = getTotalPages();
            goToTestimonial((currentIndex - 1 + pages) % pages);
        }

        function startTestimonialAutoplay() {
            stopTestimonialAutoplay();
            testimonialInterval = setInterval(nextTestimonial, 4000);
        }

        function stopTestimonialAutoplay() {
            clearInterval(testimonialInterval);
        }

        buildDots();
        goToTestimonial(0);

        if (prevBtn) prevBtn.addEventListener('click', () => { prevTestimonial(); startTestimonialAutoplay(); });
        if (nextBtn) nextBtn.addEventListener('click', () => { nextTestimonial(); startTestimonialAutoplay(); });

        const carousel = document.getElementById('testimonialCarousel');
        if (carousel) {
            carousel.addEventListener('mouseenter', stopTestimonialAutoplay);
            carousel.addEventListener('mouseleave', startTestimonialAutoplay);
        }

        // Touch swipe
        let tStartX = 0;
        testimonialTrack.addEventListener('touchstart', e => { tStartX = e.touches[0].clientX; stopTestimonialAutoplay(); }, { passive: true });
        testimonialTrack.addEventListener('touchend', e => {
            const diff = tStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) nextTestimonial();
                else prevTestimonial();
            }
            startTestimonialAutoplay();
        }, { passive: true });

        window.addEventListener('resize', () => {
            cardsPerView = getCardsPerView();
            buildDots();
            goToTestimonial(Math.min(currentIndex, getTotalPages() - 1));
        });

        startTestimonialAutoplay();
    }
});
</script>
@endsection
