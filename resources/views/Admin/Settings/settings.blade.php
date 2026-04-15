{{-- resources/views/Admin/Settings/settings.blade.php --}}
@extends('Layouts.admin')

@section('title', 'Pengaturan Toko | Slice Bread Bakery')

@section('header_title', 'Shop Settings')
@section('header_subtitle', 'Konfigurasi informasi toko dan preferensi pesanan Anda.')

@section('content')

    <form action="#" method="POST" class="space-y-6 max-w-5xl">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-[#EAE2D6]">
            <h2 class="font-heading text-xl font-bold text-[#452A1B] mb-6">Store Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                
                <div>
                    <label for="store_name" class="block text-sm font-bold text-[#855333] mb-2">Store Name</label>
                    <input type="text" id="store_name" name="store_name" value="Slice Bread Bakery" 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors">
                </div>

                <div>
                    <label for="tagline" class="block text-sm font-bold text-[#855333] mb-2">Tagline</label>
                    <input type="text" id="tagline" name="tagline" value="Cakes, Bread & More..." 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors">
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-[#855333] mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="admin@slicebread.com" 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-bold text-[#855333] mb-2">Phone Number</label>
                    <input type="text" id="phone" name="phone" value="081234567890" 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors">
                </div>

                <div>
                    <label for="address" class="block text-sm font-bold text-[#855333] mb-2">Address</label>
                    <input type="text" id="address" name="address" value="Surakarta, Indonesia" 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors">
                </div>

                <div>
                    <label for="hours" class="block text-sm font-bold text-[#855333] mb-2">Business Hours</label>
                    <input type="text" id="hours" name="hours" value="08:00 - 22:00" 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors">
                </div>

            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-[#EAE2D6]">
            
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-[#EAE2D6]/50 flex items-center justify-center text-[#452A1B] text-xl">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div>
                    <h2 class="font-heading text-xl font-bold text-[#452A1B]">WhatsApp Business Settings</h2>
                    <p class="text-sm text-gray-500">Nomor ini akan menerima format pesanan dari pelanggan.</p>
                </div>
            </div>

            <div class="mb-6">
                <label for="wa_number" class="block text-sm font-bold text-[#855333] mb-2">WhatsApp Recipient Number</label>
                <input type="text" id="wa_number" name="wa_number" value="+62 812 1314 1500" 
                    class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors">
                <p class="text-xs text-gray-500 mt-2">Gunakan kode negara (contoh: +62 untuk Indonesia). Nomor ini akan dihubungkan dengan tombol "Order Now" pada halaman promo.</p>
            </div>

            <div class="bg-[#EAE2D6]/40 rounded-xl p-5 border border-[#EAE2D6]">
                <span class="text-xs font-bold text-[#855333] uppercase tracking-wider mb-3 block">Preview Pesan:</span>
                
                <div class="bg-white rounded-lg p-4 shadow-sm relative">
                    <div class="absolute -left-2 top-4 w-4 h-4 bg-white transform rotate-45"></div>
                    
                    <p class="text-sm text-[#452A1B] relative z-10">
                        Halo Slice Bread Bakery, saya mau pesan <span class="font-bold">Dubai Series Cake</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1 relative z-10">
                        Harga: Rp 89.000
                    </p>
                </div>
            </div>

        </div>

        <div class="flex justify-end gap-4 mt-8">
            <button type="button" class="px-6 py-3 rounded-xl text-sm font-bold text-[#855333] hover:bg-[#EAE2D6] transition-colors">
                Batal
            </button>
            <button type="submit" class="bg-[#452A1B] hover:bg-[#5C3925] text-white px-8 py-3 rounded-xl text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
                <i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>

    </form>

@endsection