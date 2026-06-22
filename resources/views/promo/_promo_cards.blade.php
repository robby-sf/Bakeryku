@php
    $defaultPromoImage = 'https://images.unsplash.com/photo-1598373182133-52452f7691ef?q=80&w=2070&auto=format&fit=crop';
    $normalizedWaNumber = preg_replace('/\D+/', '', $waNumber ?? '+62 856 0238 5989');
@endphp

@forelse ($promos as $promo)
    @php
        $promoMessage = rawurlencode('Halo Slice Bread Bakery, saya mau pesan promo: ' . $promo->title . '. Apakah masih tersedia?');
        $promoImage = $promo->image ? Storage::url($promo->image) : $defaultPromoImage;
        
        $statusColor = match($promo->status) {
            'Berjalan' => 'bg-emerald-500',
            'Akan Datang' => 'bg-amber-500',
            default => 'bg-gray-400',
        };
        
        $daysLeft = now()->diffInDays($promo->end_date, false);
        $urgencyText = $daysLeft <= 3 ? 'Segera Berakhir!' : ($daysLeft <= 7 ? 'Tinggal ' . $daysLeft . ' hari' : 's/d ' . $promo->end_date->translatedFormat('d M Y'));
        $isUrgent = $daysLeft <= 3;
    @endphp

    <article class="promo-card bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl group relative border border-gray-100/80">
        
        {{-- Image Section --}}
        <div class="relative h-52 md:h-56 overflow-hidden">
            <img src="{{ $promoImage }}" alt="{{ $promo->title }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-out">
            
            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>
            
            {{-- Badge --}}
            <div class="absolute top-4 left-4">
                <span class="promo-badge inline-flex items-center gap-1.5 bg-red-500 text-white font-bold text-[10px] md:text-xs px-3.5 py-1.5 rounded-full shadow-lg font-promo">
                    <i class="fa-solid fa-tag"></i>
                    {{ $promo->badge_label }}
                </span>
            </div>

            {{-- Status Indicator --}}
            <div class="absolute top-4 right-4">
                <span class="inline-flex items-center gap-1.5 {{ $statusColor }} text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-md backdrop-blur-sm font-promo">
                    <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                    {{ $promo->status }}
                </span>
            </div>

            {{-- Display Value Overlay --}}
            <div class="absolute bottom-4 left-4">
                <div class="bg-white/95 backdrop-blur-sm rounded-xl px-4 py-2 shadow-lg">
                    <span class="font-promo font-extrabold text-xl md:text-2xl text-brand-primary">{{ $promo->display_value }}</span>
                </div>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="p-5 md:p-6 font-promo">
            {{-- Title --}}
            <h3 class="font-promo text-lg md:text-xl font-bold text-brand-dark mb-2 group-hover:text-brand-primary transition duration-300">
                {{ $promo->title }}
            </h3>

            {{-- Description --}}
            <p class="text-xs md:text-sm text-gray-500 mb-4 line-clamp-2 leading-relaxed font-promo">
                {{ $promo->description ?: 'Promo spesial Slice Bread Bakery. Berlaku selama periode promo.' }}
            </p>

            {{-- Period Info --}}
            <div class="flex items-center gap-2 mb-5 pb-5 border-b border-gray-100 font-promo">
                <div class="w-8 h-8 rounded-full bg-brand-light flex items-center justify-center flex-shrink-0">
                    <i class="fa-regular fa-calendar text-brand-primary text-xs"></i>
                </div>
                <div class="flex-1 min-w-0 font-promo">
                    @if($isUrgent)
                        <span class="text-xs font-bold text-red-500 flex items-center gap-1 font-promo">
                            <i class="fa-solid fa-clock text-[10px]"></i> {{ $urgencyText }}
                        </span>
                    @else
                        <span class="text-xs text-gray-400 font-promo">{{ $urgencyText }}</span>
                    @endif
                    <div class="text-[10px] text-gray-300 mt-0.5 font-promo">
                        {{ $promo->start_date->translatedFormat('d M') }} — {{ $promo->end_date->translatedFormat('d M Y') }}
                    </div>
                </div>
            </div>

            {{-- CTA Button --}}
            <a href="https://wa.me/{{ $normalizedWaNumber }}?text={{ $promoMessage }}" target="_blank" 
               class="w-full bg-[#25D366] text-white font-bold py-3 rounded-xl hover:bg-[#128C7E] transition duration-300 text-sm shadow-md hover:shadow-lg flex justify-center items-center gap-2 group/btn font-promo">
                <i class="fa-brands fa-whatsapp text-lg group-hover/btn:scale-110 transition duration-300"></i>
                <span>Pesan Sekarang</span>
                <i class="fa-solid fa-arrow-right text-xs opacity-0 group-hover/btn:opacity-100 group-hover/btn:translate-x-1 transition duration-300"></i>
            </a>
        </div>
    </article>

@empty
    <div class="col-span-full font-promo">
        <div class="text-center py-16 md:py-24 bg-white rounded-3xl border-2 border-dashed border-gray-200 font-promo">
            <div class="w-20 h-20 bg-brand-light rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-gift text-brand-primary text-3xl"></i>
            </div>
            <h3 class="font-promo text-xl md:text-2xl font-bold text-brand-dark mb-2">Belum Ada Promo Aktif</h3>
            <p class="text-sm text-gray-400 max-w-sm mx-auto mb-6 font-promo">
                Promo baru akan segera hadir! Pantau terus halaman ini atau hubungi kami untuk info terbaru.
            </p>
            @php
                $emptyMsg = rawurlencode('Halo Slice Bread Bakery, ada promo terbaru nggak?');
            @endphp
            <a href="https://wa.me/{{ $normalizedWaNumber }}?text={{ $emptyMsg }}" target="_blank"
               class="inline-flex items-center gap-2 bg-brand-primary hover:bg-brand-dark text-white font-bold py-2.5 px-6 rounded-full transition duration-300 text-sm shadow-md font-promo">
                <i class="fa-brands fa-whatsapp text-lg"></i>
                Hubungi Kami
            </a>
        </div>
    </div>
@endforelse
