{{-- resources/views/Admin/Settings/settings.blade.php --}}
@extends('layouts.admin')

@section('title', 'Pengaturan Toko | Slice Bread Bakery')

@section('header_title', 'Shop Settings')
@section('header_subtitle', 'Konfigurasi informasi toko dan preferensi pesanan Anda.')

@section('content')

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <h3 class="font-semibold text-red-800 mb-2">Ada kesalahan:</h3>
            <ul class="list-disc list-inside space-y-1 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h3 class="font-semibold text-green-800">Berhasil!</h3>
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6 max-w-5xl">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-[#EAE2D6]">
            <h2 class="font-heading text-xl font-bold text-[#452A1B] mb-6">Store Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                
                <div>
                    <label for="store_name" class="block text-sm font-bold text-[#855333] mb-2">Store Name</label>
                    <input type="text" id="store_name" name="store_name" value="{{ old('store_name', $settings['store_name'] ?? 'Slice Bread Bakery') }}" 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors @error('store_name') border-red-500 @enderror">
                    @error('store_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="tagline" class="block text-sm font-bold text-[#855333] mb-2">Tagline</label>
                    <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $settings['tagline'] ?? 'Cakes, Bread & More...') }}" 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors @error('tagline') border-red-500 @enderror">
                    @error('tagline')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-[#855333] mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $settings['email'] ?? 'admin@slicebread.com') }}" 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors @error('email') border-red-500 @enderror">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-bold text-[#855333] mb-2">Phone Number</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $settings['phone'] ?? '085602385989') }}" 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors @error('phone') border-red-500 @enderror">
                    @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-bold text-[#855333] mb-2">Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $settings['address'] ?? 'Surakarta, Indonesia') }}" 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors @error('address') border-red-500 @enderror">
                    @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="hours" class="block text-sm font-bold text-[#855333] mb-2">Business Hours</label>
                    <input type="text" id="hours" name="hours" value="{{ old('hours', $settings['hours'] ?? '08:00 - 22:00') }}" 
                        class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors @error('hours') border-red-500 @enderror">
                    @error('hours')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
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
                <input type="text" id="wa_number" name="wa_number" value="{{ old('wa_number', $settings['wa_number'] ?? '+62 856 0238 5989') }}" 
                    class="w-full bg-[#FAF8F5] border border-[#EAE2D6] rounded-xl px-4 py-3 text-sm text-[#452A1B] font-medium focus:outline-none focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] transition-colors @error('wa_number') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-2">Gunakan kode negara (contoh: +62 untuk Indonesia). Nomor ini akan dihubungkan dengan tombol "Order Now" pada halaman promo.</p>
                @error('wa_number')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="bg-[#EAE2D6]/40 rounded-xl p-5 border border-[#EAE2D6]">
                <span class="text-xs font-bold text-[#855333] uppercase tracking-wider mb-3 block">Preview Pesan:</span>
                
                <div class="bg-white rounded-lg p-4 shadow-sm relative">
                    <div class="absolute -left-2 top-4 w-4 h-4 bg-white transform rotate-45"></div>
                    
                    <p class="text-sm text-[#452A1B] relative z-10">
                        Halo {{ $settings['store_name'] ?? 'Slice Bread Bakery' }}, saya mau pesan <span class="font-bold">Dubai Series Cake</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1 relative z-10">
                        Harga: Rp 89.000
                    </p>
                </div>
            </div>

        </div>

        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-[#855333] hover:bg-[#EAE2D6] transition-colors">
                Batal
            </a>
            <button type="submit" class="bg-[#452A1B] hover:bg-[#5C3925] text-white px-8 py-3 rounded-xl text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
                <i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>

    </form>

@endsection