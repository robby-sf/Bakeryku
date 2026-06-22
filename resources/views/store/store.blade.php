@extends('layouts.app')

@section('title', 'Our Store | Slice Bread Bakery')

@section('content')
    @php
        $storeImages = [];
        if (isset($products) && $products->isNotEmpty()) {
            foreach ($products as $prod) {
                if ($prod->image) {
                    $storeImages[] = Storage::url($prod->image);
                }
            }
        }
        // Fallback images from storage
        if (empty($storeImages)) {
            $storeImages = [
                Storage::url('products/Roll Cake.jpg'),
                Storage::url('products/Roti Tawar.jpg'),
                Storage::url('products/Blueberry Cheese.jpg'),
                Storage::url('products/Kue Lapis Mandarin.png'),
                Storage::url('products/Donat Meses Keju.jpg')
            ];
        }
    @endphp
    <div class="py-12 md:py-20 bg-brand-light">
        <div class="container mx-auto px-4 md:px-6 max-w-6xl">
            
            <div class="text-center mb-10 md:mb-16 scroll-reveal">
                <span class="text-brand-primary font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-2 block">Lokasi Toko</span>
                <h1 class="font-heading text-4xl md:text-5xl font-bold text-brand-dark mb-4">Slice Bread Bakery</h1>
                <div class="w-15 h-[3px] bg-gradient-to-r from-brand-primary to-[#C4835A] rounded-sm mx-auto"></div>
            </div>

            <div class="bg-white rounded-3xl overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col lg:flex-row min-h-[550px] group scroll-reveal">
                
                <div class="w-full lg:w-1/2 flex flex-col">
                    <div class="h-64 sm:h-80 lg:h-72 overflow-hidden relative bg-gray-100" id="storeSlider">
                        @foreach($storeImages as $index => $imgUrl)
                            <div class="store-slide absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-1' : 'opacity-0 z-0' }}" data-index="{{ $index }}">
                                <img src="{{ $imgUrl }}" alt="Slice Bread Bakery Produk {{ $index + 1 }}" class="w-full h-full object-cover transition-transform duration-[8000ms] ease-out" style="transform: scale(1);">
                            </div>
                        @endforeach
                        <div class="absolute top-4 left-4 bg-brand-primary text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-md animate-[float_3s_ease-in-out_infinite] z-10">
                            Toko Pusat
                        </div>
                        {{-- Gradient overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-60 z-5"></div>
                        
                        @if(count($storeImages) > 1)
                            <div class="absolute bottom-4 right-4 flex gap-1.5 z-10">
                                @foreach($storeImages as $index => $imgUrl)
                                    <button class="store-dot w-2 h-2 rounded-full bg-white/40 hover:bg-white/80 transition-all duration-300 {{ $index === 0 ? 'bg-white scale-125' : '' }}" data-target="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6 md:p-10 flex flex-col justify-center flex-grow">
                        {{-- Rating --}}
                        <div class="flex items-center gap-2 mb-2 scroll-reveal">
                            <span class="font-bold text-brand-dark text-lg leading-none">5,0</span>
                            <div class="flex text-yellow-400 text-sm gap-0.5">
                                @for($i = 0; $i < 5; $i++)
                                    <i class="fa-solid fa-star hover:scale-125 transition-transform duration-200 cursor-default" style="transition-delay: {{ $i * 50 }}ms"></i>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-400 font-medium ml-1">(5 ulasan)</span>
                        </div>

                        <h2 class="font-heading text-2xl md:text-3xl font-bold text-brand-dark mb-1 scroll-reveal">Slice Bread Bakery</h2>
                        <p class="text-gray-500 text-sm mb-6 scroll-reveal">Toko Roti</p>
                        
                        <div class="space-y-5 mb-8">
                            {{-- Takeaway badge --}}
                            <div class="flex items-center gap-3 text-sm text-brand-dark font-medium border-b border-gray-50 pb-4 scroll-reveal">
                                <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-check text-green-600 text-xs"></i>
                                </div>
                                Bawa pulang
                            </div>

                            {{-- Address --}}
                            <div class="flex items-start gap-4 scroll-reveal group/item">
                                <div class="w-9 h-9 rounded-full bg-[#FCF9F5] flex items-center justify-center flex-shrink-0 mt-1 group-hover/item:bg-brand-primary/10 transition-colors duration-300">
                                    <i class="fa-solid fa-location-dot text-brand-primary text-sm group-hover/item:scale-110 transition-transform duration-300"></i>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm leading-relaxed">Teguhan Lor, RT.07/RW.03, Sragen Wetan, Kabupaten Sragen, Jawa Tengah</p>
                                    <p class="text-gray-400 text-[11px] mt-1 uppercase tracking-tight">H29J+W9 Sragen Wetan, Sragen</p>
                                </div>
                            </div>
                            
                            {{-- Hours --}}
                            <div class="flex items-start gap-4 scroll-reveal group/item">
                                <div class="w-9 h-9 rounded-full bg-[#FCF9F5] flex items-center justify-center flex-shrink-0 mt-1 group-hover/item:bg-brand-primary/10 transition-colors duration-300">
                                    <i class="fa-solid fa-clock text-brand-primary text-sm group-hover/item:scale-110 transition-transform duration-300"></i>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm mt-1">
                                        <span class="text-green-600 font-bold">Buka</span> · Tutup pukul 21.00
                                    </p>
                                    {{-- Hours detail (expandable) --}}
                                    <button id="toggleHours" class="text-brand-primary text-xs font-semibold mt-1 flex items-center gap-1 hover:gap-2 transition-all duration-300">
                                        Lihat jam operasional <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-300" id="hoursChevron"></i>
                                    </button>
                                    <div id="hoursDetail" class="hidden mt-3 space-y-1.5 text-xs text-gray-500 overflow-hidden">
                                        <div class="flex justify-between"><span>Senin - Jumat</span><span class="font-medium text-gray-700">07.00 - 21.00</span></div>
                                        <div class="flex justify-between"><span>Sabtu</span><span class="font-medium text-gray-700">06.30 - 21.00</span></div>
                                        <div class="flex justify-between"><span>Minggu</span><span class="font-medium text-gray-700">07.00 - 20.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Action buttons --}}
                        <div class="flex flex-wrap gap-3 scroll-reveal">
                            <a href="https://www.google.com/maps/dir//Sragen+Wetan,+Sragen+Regency,+Central+Java/" target="_blank" class="bg-brand-primary hover:bg-brand-dark text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 flex items-center gap-2 text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 active:scale-95">
                                <i class="fa-solid fa-diamond-turn-right text-xs"></i> Rute
                            </a>
                            <button id="saveBtn" class="border border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-white font-semibold py-3 px-6 rounded-full transition-all duration-300 flex items-center gap-2 text-sm active:scale-95">
                                <i class="fa-regular fa-bookmark" id="saveIcon"></i> <span id="saveText">Simpan</span>
                            </button>
                            <button id="shareBtn" class="border border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-white font-semibold py-3 px-6 rounded-full transition-all duration-300 flex items-center gap-2 text-sm active:scale-95">
                                <i class="fa-solid fa-share-nodes"></i> Bagikan
                            </button>
                        </div>
                    </div>
                </div>
                
                {{-- Map --}}
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

            {{-- Contact CTA --}}
            @php
                $waNumberSetting = cache('app_settings')['wa_number'] ?? '+62 856 0238 5989';
                $cleanWaSetting = preg_replace('/\D+/', '', $waNumberSetting);
                if (str_starts_with($cleanWaSetting, '0')) {
                    $cleanWaSetting = '62' . substr($cleanWaSetting, 1);
                }
            @endphp
            <div class="mt-12 text-center text-gray-500 text-sm scroll-reveal">
                <p>Ingin memesan lewat telepon? Hubungi kami di 
                    <a href="tel:{{ $cleanWaSetting }}" class="font-bold text-brand-primary hover:text-brand-dark transition-colors duration-300 underline decoration-brand-primary/30 hover:decoration-brand-primary underline-offset-4">
                        {{ $waNumberSetting }}
                    </a>
                </p>
            </div>

        </div>
    </div>

    {{-- Share Modal --}}
    <div id="shareModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" id="shareOverlay"></div>
        <div class="relative bg-white rounded-2xl p-6 md:p-8 w-full max-w-sm shadow-2xl translate-y-4 transition-transform duration-300" id="shareContent">
            <button id="closeShare" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 hover:text-brand-dark transition-all duration-300">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
            <h3 class="font-heading text-lg font-bold text-brand-dark mb-4">Bagikan Lokasi</h3>
            <div class="grid grid-cols-3 gap-3">
                <a href="https://wa.me/?text=Slice+Bread+Bakery+Sragen+-+https://maps.google.com" target="_blank" class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50 transition-all duration-300 group/share">
                    <div class="w-12 h-12 rounded-full bg-[#25D366]/10 flex items-center justify-center group-hover/share:scale-110 transition-transform duration-300">
                        <i class="fa-brands fa-whatsapp text-[#25D366] text-xl"></i>
                    </div>
                    <span class="text-xs text-gray-600">WhatsApp</span>
                </a>
                <button onclick="navigator.clipboard.writeText(window.location.href);this.querySelector('span').textContent='Tersalin!';setTimeout(()=>this.querySelector('span').textContent='Salin Link',2000)" class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50 transition-all duration-300 group/share">
                    <div class="w-12 h-12 rounded-full bg-brand-primary/10 flex items-center justify-center group-hover/share:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-link text-brand-primary text-lg"></i>
                    </div>
                    <span class="text-xs text-gray-600">Salin Link</span>
                </button>
                <a href="mailto:?subject=Slice Bread Bakery&body=Cek toko roti ini: https://maps.google.com" class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50 transition-all duration-300 group/share">
                    <div class="w-12 h-12 rounded-full bg-blue-500/10 flex items-center justify-center group-hover/share:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-envelope text-blue-500 text-lg"></i>
                    </div>
                    <span class="text-xs text-gray-600">Email</span>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== STORE SLIDER =====
    const storeSlider = document.getElementById('storeSlider');
    if (storeSlider) {
        const slides = storeSlider.querySelectorAll('.store-slide');
        const dots = storeSlider.querySelectorAll('.store-dot');
        let currentSlide = 0;
        let slideInterval = null;
        const DURATION = 4000;

        function goToSlide(index) {
            slides.forEach((s, idx) => {
                const img = s.querySelector('img');
                if (idx === index) {
                    s.classList.remove('opacity-0', 'z-0');
                    s.classList.add('opacity-100', 'z-1');
                    if (img) img.style.transform = 'scale(1.05)';
                } else {
                    s.classList.remove('opacity-100', 'z-1');
                    s.classList.add('opacity-0', 'z-0');
                    if (img) img.style.transform = 'scale(1)';
                }
            });

            dots.forEach((d, idx) => {
                if (idx === index) {
                    d.classList.add('bg-white', 'scale-125');
                    d.classList.remove('bg-white/40');
                } else {
                    d.classList.remove('bg-white', 'scale-125');
                    d.classList.add('bg-white/40');
                }
            });

            currentSlide = index;
        }

        function nextSlide() {
            goToSlide((currentSlide + 1) % slides.length);
        }

        function startAutoplay() {
            stopAutoplay();
            slideInterval = setInterval(nextSlide, DURATION);
        }

        function stopAutoplay() {
            clearInterval(slideInterval);
        }

        dots.forEach(dot => {
            dot.addEventListener('click', (e) => {
                e.preventDefault();
                goToSlide(parseInt(dot.dataset.target));
                startAutoplay();
            });
        });

        storeSlider.addEventListener('mouseenter', stopAutoplay);
        storeSlider.addEventListener('mouseleave', startAutoplay);

        // Start initial scale
        const firstImg = slides[0].querySelector('img');
        if (firstImg) firstImg.style.transform = 'scale(1.05)';

        if (slides.length > 1) startAutoplay();
    }

    // Scroll reveal
    const els = document.querySelectorAll('.scroll-reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
    els.forEach(el => observer.observe(el));

    // Toggle hours
    const toggleBtn = document.getElementById('toggleHours');
    const hoursDetail = document.getElementById('hoursDetail');
    const chevron = document.getElementById('hoursChevron');
    if (toggleBtn && hoursDetail) {
        toggleBtn.addEventListener('click', () => {
            const isHidden = hoursDetail.classList.contains('hidden');
            hoursDetail.classList.toggle('hidden');
            chevron.style.transform = isHidden ? 'rotate(180deg)' : '';
        });
    }

    // Save button toggle
    const saveBtn = document.getElementById('saveBtn');
    const saveIcon = document.getElementById('saveIcon');
    const saveText = document.getElementById('saveText');
    let saved = false;
    if (saveBtn) {
        saveBtn.addEventListener('click', () => {
            saved = !saved;
            saveIcon.className = saved ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark';
            saveText.textContent = saved ? 'Tersimpan' : 'Simpan';
            if (saved) {
                saveBtn.classList.add('bg-brand-primary', 'text-white', 'border-brand-primary');
            } else {
                saveBtn.classList.remove('bg-brand-primary', 'text-white');
            }
        });
    }

    // Share modal
    const shareBtn = document.getElementById('shareBtn');
    const shareModal = document.getElementById('shareModal');
    const shareOverlay = document.getElementById('shareOverlay');
    const shareContent = document.getElementById('shareContent');
    const closeShare = document.getElementById('closeShare');

    function openModal() {
        shareModal.classList.remove('opacity-0', 'pointer-events-none');
        shareContent.classList.remove('translate-y-4');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        shareModal.classList.add('opacity-0', 'pointer-events-none');
        shareContent.classList.add('translate-y-4');
        document.body.style.overflow = '';
    }

    if (shareBtn) shareBtn.addEventListener('click', openModal);
    if (closeShare) closeShare.addEventListener('click', closeModal);
    if (shareOverlay) shareOverlay.addEventListener('click', closeModal);
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });
});
</script>
@endsection