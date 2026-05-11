@php
    $defaultPromoImage = 'https://images.unsplash.com/photo-1598373182133-52452f7691ef?q=80&w=2070&auto=format&fit=crop';
    $normalizedWaNumber = preg_replace('/\D+/', '', $waNumber ?? '+62 812 1314 1500');
@endphp

@forelse ($promos as $promo)
    @php
        $promoMessage = rawurlencode('Halo Slice Bread Bakery, saya mau pesan promo: ' . $promo->title . '. Apakah masih tersedia?');
        $promoImage = $promo->image ? Storage::url($promo->image) : $defaultPromoImage;
    @endphp

    <article class="bg-brand-card rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 group min-w-[280px] md:min-w-[320px] max-w-[320px] snap-start flex-shrink-0 relative border border-gray-100">
        <div class="absolute top-0 left-0 bg-red-500 text-white font-bold text-[10px] md:text-xs px-3 py-1.5 rounded-br-xl z-10 shadow-md flex items-center gap-1">
            <i class="fa-solid fa-gift"></i> {{ $promo->badge_label }}
        </div>

        <div class="relative h-48 md:h-52 overflow-hidden">
            <img src="{{ $promoImage }}" alt="{{ $promo->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        </div>

        <div class="p-5 flex flex-col h-[220px]">
            <h3 class="font-heading text-lg font-bold mb-1 text-brand-dark">{{ $promo->title }}</h3>
            <p class="text-xs text-gray-500 mb-4 flex-1">{{ $promo->description ?: 'Promo spesial Slice Bread Bakery. Berlaku selama periode promo.' }}</p>

            <div class="flex justify-between items-center mb-4">
                <div>
                    <span class="text-gray-400 text-xs line-through decoration-red-500">s/d {{ $promo->end_date->translatedFormat('d M Y') }}</span>
                    <div class="font-bold text-brand-primary text-lg">{{ $promo->display_value }}</div>
                </div>
                <span class="bg-green-50 text-green-600 text-[10px] font-bold px-2 py-1 rounded border border-green-100">{{ $promo->status }}</span>
            </div>

            <a href="https://wa.me/{{ $normalizedWaNumber }}?text={{ $promoMessage }}" target="_blank" class="w-full bg-[#25D366] text-white font-bold py-2.5 rounded-full hover:bg-[#128C7E] transition duration-300 text-sm shadow-md flex justify-center items-center gap-2">
                <i class="fa-brands fa-whatsapp text-lg"></i> Order Now
            </a>
        </div>
    </article>
@empty
    <div class="min-w-full text-center py-12">
        <p class="text-sm font-bold text-brand-dark">Belum ada promo yang sedang berjalan.</p>
        <p class="text-xs text-gray-500 mt-1">Promo baru dari admin akan tampil di sini saat periodenya aktif.</p>
    </div>
@endforelse
