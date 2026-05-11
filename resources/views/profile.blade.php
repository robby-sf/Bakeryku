@extends('layouts.app')

@section('title', 'Profil Saya | Ananda Bakery')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-brand-dark">Profil Saya</h2>
        <p class="text-gray-500 mt-2 text-sm">Kelola informasi data diri dan pengaturan keamanan akun Anda.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        
        <div class="xl:col-span-1">
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm text-center sticky top-20">
                <div class="w-32 h-32 mx-auto rounded-full bg-brand-light flex items-center justify-center text-brand-primary mb-4 border-4 border-white shadow-md">
                    <i class="fa-solid fa-user text-4xl"></i>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                <p class="text-sm text-gray-500 font-medium mt-1">Pelanggan Setia</p>

                <div class="mt-6 pt-6 border-t border-gray-100 text-left space-y-4">
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Lahir</span>
                        <span class="text-sm font-medium text-gray-900">
                            @if($user->date_of_birth)
                                {{ $user->date_of_birth->format('d M Y') }}
                            @else
                                <span class="text-gray-400 italic">Belum diisi</span>
                            @endif
                        </span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">No. WhatsApp</span>
                        <span class="text-sm font-medium text-gray-900">
                            @if($user->phone)
                                {{ $user->phone }}
                            @else
                                <span class="text-gray-400 italic">Belum diisi</span>
                            @endif
                        </span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Email</span>
                        <span class="text-sm font-medium text-gray-900 break-all">{{ $user->email }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="xl:col-span-2 space-y-6">
            
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-900">Informasi Pribadi</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-brand-primary outline-none transition-all text-sm @error('name') border-red-500 @enderror">
                                @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-brand-primary outline-none transition-all text-sm @error('date_of_birth') border-red-500 @enderror">
                                @error('date_of_birth')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Cth: 0856-7890-1234" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-brand-primary outline-none transition-all text-sm @error('phone') border-red-500 @enderror">
                                @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-brand-primary outline-none transition-all text-sm @error('email') border-red-500 @enderror">
                                @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman Utama</label>
                                <textarea name="address" rows="3" placeholder="Cth: Jl. Mawar No. 12, RT 03 / RW 05, Kelurahan Suka Maju" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-brand-primary outline-none transition-all text-sm @error('address') border-red-500 @enderror">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-6 py-2.5 bg-brand-primary hover:bg-brand-dark text-white text-sm font-bold rounded-lg transition-colors shadow-sm">
                                <i class="fa-solid fa-save mr-2"></i> Simpan Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-900">Ubah Kata Sandi</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Saat Ini</label>
                                <input type="password" name="current_password" placeholder="••••••••" class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-brand-primary outline-none transition-all text-sm @error('current_password') border-red-500 @enderror">
                                @error('current_password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="border-t border-gray-100 pt-5 mt-5 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Baru</label>
                                    <input type="password" name="password" placeholder="Masukkan sandi baru" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-brand-primary outline-none transition-all text-sm @error('password') border-red-500 @enderror">
                                    @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Sandi Baru</label>
                                    <input type="password" name="password_confirmation" placeholder="Ulangi sandi baru" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-brand-primary outline-none transition-all text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-6 py-2.5 bg-gray-800 hover:bg-gray-900 text-white text-sm font-bold rounded-lg transition-colors shadow-sm">
                                <i class="fa-solid fa-key mr-2"></i> Perbarui Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
