<footer class="bg-brand-dark mt-auto">
    {{-- Main footer content --}}
    <div class="container mx-auto px-6 md:px-10 pt-14 md:pt-20 pb-8">

        {{-- Top: Brand + Navigation Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10 md:gap-8 pb-10 md:pb-14 border-b border-white/10">

            {{-- Brand column --}}
            <div class="md:col-span-4 lg:col-span-5">
                <a href="/" class="inline-flex items-center gap-0 mb-5 md:mb-6 group">
                    <div class="flex flex-col items-start">
                        <span class="font-heading font-bold text-xl md:text-2xl text-brand-light leading-none italic group-hover:text-brand-primary transition-colors duration-300">Slice Bread</span>
                        <div class="w-full flex items-center gap-1.5 mt-1">
                            <span class="flex-1 h-px bg-white/20"></span>
                            <span class="text-[7px] md:text-[8px] uppercase tracking-[0.25em] text-white/40 font-semibold whitespace-nowrap">Bakery & Pastry</span>
                            <span class="flex-1 h-px bg-white/20"></span>
                        </div>
                    </div>
                </a>
                <p class="text-sm text-white/50 leading-relaxed max-w-xs mb-6 md:mb-8">
                    Toko roti & pastry premium dengan cita rasa autentik, menghadirkan kehangatan dan kebahagiaan di setiap gigitan.
                </p>
                {{-- Social icons --}}
                @php
                    $waNumberSetting = cache('app_settings')['wa_number'] ?? '+62 856 0238 5989';
                    $cleanWaSetting = preg_replace('/\D+/', '', $waNumberSetting);
                    if (str_starts_with($cleanWaSetting, '0')) {
                        $cleanWaSetting = '62' . substr($cleanWaSetting, 1);
                    }
                @endphp
                <div class="flex items-center gap-3">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:bg-brand-primary hover:border-brand-primary hover:text-white transition-all duration-300" aria-label="Instagram">
                        <i class="fa-brands fa-instagram text-base"></i>
                    </a>
                    <a href="https://wa.me/{{ $cleanWaSetting }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:bg-[#25D366] hover:border-[#25D366] hover:text-white transition-all duration-300" aria-label="WhatsApp">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white/50 hover:bg-brand-primary hover:border-brand-primary hover:text-white transition-all duration-300" aria-label="Facebook">
                        <i class="fa-brands fa-facebook-f text-base"></i>
                    </a>
                </div>
            </div>

            {{-- Navigation columns --}}
            <div class="md:col-span-8 lg:col-span-7 grid grid-cols-2 gap-8 max-w-md md:ml-auto w-full">
                {{-- Column 1 --}}
                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-[0.2em] text-white/30 mb-5 md:mb-6">Jelajahi</h4>
                    <ul class="space-y-3">
                        <li><a href="/" class="text-sm text-white/60 hover:text-white transition-colors duration-300">Home</a></li>
                        <li><a href="/menu" class="text-sm text-white/60 hover:text-white transition-colors duration-300">Menu</a></li>
                        <li><a href="/stores" class="text-sm text-white/60 hover:text-white transition-colors duration-300">Stores</a></li>
                        <li><a href="/promo" class="text-sm text-white/60 hover:text-white transition-colors duration-300">Promo</a></li>
                    </ul>
                </div>

                {{-- Column 3: Contact --}}
                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-[0.2em] text-white/30 mb-5 md:mb-6">Hubungi Kami</h4>
                    <ul class="space-y-4">
                        @php
                            $phoneSetting = cache('app_settings')['phone'] ?? '085602385989';
                            $cleanPhoneSetting = preg_replace('/\D+/', '', $phoneSetting);
                        @endphp
                        <li>
                            <a href="tel:{{ $cleanPhoneSetting }}" class="flex items-center gap-3 text-sm text-white/60 hover:text-white transition-colors duration-300 group">
                                <span class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center shrink-0 group-hover:bg-brand-primary/20 transition-colors duration-300">
                                    <i class="fa-solid fa-phone text-xs text-white/40 group-hover:text-brand-primary transition-colors duration-300"></i>
                                </span>
                                {{ $phoneSetting }}
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/{{ $cleanWaSetting }}" target="_blank" class="flex items-center gap-3 text-sm text-white/60 hover:text-white transition-colors duration-300 group">
                                <span class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center shrink-0 group-hover:bg-[#25D366]/20 transition-colors duration-300">
                                    <i class="fa-brands fa-whatsapp text-sm text-white/40 group-hover:text-[#25D366] transition-colors duration-300"></i>
                                </span>
                                {{ $waNumberSetting }}
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 text-sm text-white/60 hover:text-white transition-colors duration-300 group">
                                <span class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center shrink-0 group-hover:bg-brand-primary/20 transition-colors duration-300">
                                    <i class="fa-brands fa-instagram text-sm text-white/40 group-hover:text-brand-primary transition-colors duration-300"></i>
                                </span>
                                @slicebreadbakery
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-6 md:pt-8">
            <p class="text-xs text-white/30">&copy; {{ date('Y') }} Slice Bread Bakery. All rights reserved.</p>
        </div>

    </div>
</footer>