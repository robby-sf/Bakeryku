<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Ananda Bakery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-brand-light font-sans antialiased text-brand-dark">

    <div class="min-h-screen flex">
        
        <div class="hidden lg:flex lg:w-1/2 relative bg-black">
            <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=2072&auto=format&fit=crop" 
                 alt="Membuat Roti Ananda Bakery" 
                 class="absolute inset-0 w-full h-full object-cover opacity-60">
            
            <div class="absolute inset-0 flex flex-col justify-center px-16 z-10 text-white">
                <span class="bg-brand-primary text-white text-xs font-bold px-3 py-1 rounded-full w-max mb-4 uppercase tracking-wider">Anggota Baru</span>
                <h1 class="font-heading text-5xl font-bold mb-4">Awali Hari<br>dengan yang Manis.</h1>
                <p class="text-lg opacity-90 max-w-md">Buat akun sekarang untuk mendapatkan diskon khusus pengguna baru, mengumpulkan poin, dan kemudahan pemesanan.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 bg-white overflow-y-auto">
            <div class="w-full max-w-md py-8">
                
                <div class="text-center mb-8">
                    <a href="/" class="inline-block font-heading text-3xl font-bold text-brand-primary mb-2">
                        <i class="fa-solid fa-wheat-awn"></i> Ananda Bakery
                    </a>
                    <h2 class="text-2xl font-bold text-brand-dark mt-4">Daftar Akun Baru</h2>
                    <p class="text-gray-500 text-sm mt-1">Lengkapi data di bawah ini untuk bergabung.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-semibold text-brand-dark mb-1.5">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-regular fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/20 outline-none transition duration-200 bg-brand-light/50" 
                                placeholder="Cth: Budi Santoso">
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-brand-dark mb-1.5">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-regular fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/20 outline-none transition duration-200 bg-brand-light/50" 
                                placeholder="nama@email.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-brand-dark mb-1.5">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/20 outline-none transition duration-200 bg-brand-light/50" 
                                placeholder="Minimal 8 karakter">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-brand-dark mb-1.5">Konfirmasi Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-shield-halved text-gray-400"></i>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/20 outline-none transition duration-200 bg-brand-light/50" 
                                placeholder="Ulangi password">
                        </div>
                    </div>

                    <div class="flex items-start mt-2">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required
                                class="w-4 h-4 rounded border-gray-300 text-brand-primary focus:ring-brand-primary cursor-pointer">
                        </div>
                        <div class="ml-2 text-sm">
                            <label for="terms" class="text-gray-600 font-medium cursor-pointer">
                                Saya setuju dengan <a href="#" class="text-brand-primary hover:text-brand-dark font-bold transition">Syarat & Ketentuan</a> serta <a href="#" class="text-brand-primary hover:text-brand-dark font-bold transition">Kebijakan Privasi</a>.
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-brand-primary text-white font-bold py-3.5 rounded-full hover:opacity-90 transition duration-300 shadow-md mt-6">
                        Daftar Sekarang
                    </button>
                    
                    <div class="relative flex items-center py-2">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="flex-shrink-0 mx-4 text-gray-400 text-xs uppercase font-bold tracking-wider">Atau Daftar Dengan</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    <button type="button" class="w-full bg-white border border-gray-200 text-gray-700 font-bold py-3.5 rounded-full hover:bg-gray-50 transition duration-300 flex items-center justify-center gap-2">
                        <i class="fa-brands fa-google text-red-500"></i> Akun Google
                    </button>
                </form>

                <p class="text-center text-sm text-gray-600 mt-8">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-brand-primary hover:text-brand-dark transition">Masuk di sini</a>
                </p>
            </div>
        </div>
        
    </div>

</body>
</html>