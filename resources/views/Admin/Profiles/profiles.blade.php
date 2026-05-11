@extends('layouts.admin')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-[#0f172a]">Profil Admin</h2>
        <p class="text-gray-500 mt-2 text-sm">Kelola informasi data diri dan pengaturan keamanan akun Anda.</p>
    </div>

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

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        
        <div class="xl:col-span-1">
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm text-center">
                <div class="w-32 h-32 mx-auto rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mb-4 border-4 border-white shadow-md">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                <p class="text-sm text-gray-500 font-medium mt-1">Administrator</p>

                <div class="mt-6 pt-6 border-t border-gray-100 text-left space-y-4">
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Email</span>
                        <span class="text-sm font-medium text-gray-900">{{ $user->email }}</span>
                    </div>
                    @if ($user->date_of_birth)
                        <div>
                            <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Lahir</span>
                            <span class="text-sm font-medium text-gray-900">{{ $user->date_of_birth->translatedFormat('d F Y') }}</span>
                        </div>
                    @endif
                    @if ($user->last_login_at)
                        <div>
                            <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Terakhir Login</span>
                            <span class="text-sm font-medium text-gray-900">
                                @php
                                    $lastLogin = $user->last_login_at;
                                    $today = \Carbon\Carbon::today();
                                    $yesterday = \Carbon\Carbon::yesterday();
                                    
                                    if ($lastLogin->isToday()) {
                                        $date = 'Hari ini';
                                    } elseif ($lastLogin->isYesterday()) {
                                        $date = 'Kemarin';
                                    } else {
                                        $date = $lastLogin->translatedFormat('d F Y');
                                    }
                                    
                                    $time = $lastLogin->format('H:i');
                                @endphp
                                {{ $date }}, {{ $time }} WIB
                            </span>
                        </div>
                    @else
                        <div>
                            <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Bergabung Sejak</span>
                            <span class="text-sm font-medium text-gray-900">{{ $user->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="xl:col-span-2 space-y-6">
            
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-900">Informasi Pribadi</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ $user->name }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-sm @error('name') border-red-500 @enderror">
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" value="{{ $user->date_of_birth?->format('Y-m-d') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-sm @error('date_of_birth') border-red-500 @enderror">
                                @error('date_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-sm @error('email') border-red-500 @enderror">
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="text" name="phone" value="{{ $user->phone }}" placeholder="0812-3456-7890" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-sm @error('phone') border-red-500 @enderror">
                                @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                                <textarea name="address" rows="3" placeholder="Jl. Merdeka No. 45, Kelurahan Suka Maju" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-sm @error('address') border-red-500 @enderror">{{ $user->address }}</textarea>
                                @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition-colors">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-900">Ubah Kata Sandi</h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-6">Untuk keamanan akun Anda, gunakan kata sandi yang kuat dengan kombinasi huruf besar, angka, dan simbol.</p>
                    <form action="{{ route('admin.profile.password') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Saat Ini <span class="text-red-500">*</span></label>
                                <input type="password" name="current_password" placeholder="••••••••" required class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-sm @error('current_password') border-red-500 @enderror">
                                @error('current_password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="border-t border-gray-100 pt-4 mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi Baru <span class="text-red-500">*</span></label>
                                    <input type="password" name="password" placeholder="Masukkan sandi baru" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-sm @error('password') border-red-500 @enderror">
                                    <p class="text-xs text-gray-500 mt-2">Minimal 8 karakter, huruf besar/kecil, angka, dan simbol</p>
                                    @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Sandi Baru <span class="text-red-500">*</span></label>
                                    <input type="password" name="password_confirmation" placeholder="Ulangi sandi baru" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-sm @error('password_confirmation') border-red-500 @enderror">
                                    @error('password_confirmation')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-900 focus:ring-4 focus:ring-gray-200 transition-colors">
                                Perbarui Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection