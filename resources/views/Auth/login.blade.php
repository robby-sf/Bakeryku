<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Ananda Bakery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-brand-light font-sans antialiased text-brand-dark">

    <div class="min-h-screen flex">
        
        <div class="hidden lg:flex lg:w-1/2 relative bg-black">
            <img src="https://images.unsplash.com/photo-1555507036-ab1f40ce88cb?q=80&w=1964&auto=format&fit=crop" 
                 alt="Ananda Bakery Pastry" 
                 class="absolute inset-0 w-full h-full object-cover opacity-70">
            
            <div class="absolute inset-0 flex flex-col justify-center px-16 z-10 text-white">
                <h1 class="font-heading text-5xl font-bold mb-4">Kembali ke<br>Rasa Favoritmu.</h1>
                <p class="text-lg opacity-90 max-w-md">Masuk untuk menikmati promo eksklusif, melacak pesanan, dan menyimpan menu bakery favoritmu.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 md:p-16 bg-white">
            <div class="w-full max-w-md">
                
                <div class="text-center mb-10">
                    <a href="/" class="inline-block font-heading text-3xl font-bold text-brand-primary mb-2">
                        <i class="fa-solid fa-wheat-awn"></i> Ananda Bakery
                    </a>
                    <h2 class="text-2xl font-bold text-brand-dark mt-4">Selamat Datang Kembali</h2>
                    <p class="text-gray-500 text-sm mt-1">Silakan masukkan email dan password kamu.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-semibold text-brand-dark mb-1.5">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-regular fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" id="email" required autofocus
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
                                placeholder="••••••••">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand-primary">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-brand-primary focus:ring-brand-primary w-4 h-4">
                            <span class="text-gray-600 font-medium">Ingat Saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="font-bold text-brand-primary hover:text-brand-dark transition">Lupa Password?</a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-brand-primary text-white font-bold py-3.5 rounded-full hover:opacity-90 transition duration-300 shadow-md">
                        Masuk
                    </button>
                    
                    <div class="relative flex items-center py-2">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="flex-shrink-0 mx-4 text-gray-400 text-xs uppercase font-bold tracking-wider">Atau</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    <button type="button" class="w-full bg-white border border-gray-200 text-gray-700 font-bold py-3.5 rounded-full hover:bg-gray-50 transition duration-300 flex items-center justify-center gap-2">
                        <i class="fa-brands fa-google text-red-500"></i> Masuk dengan Google
                    </button>
                </form>

                <p class="text-center text-sm text-gray-600 mt-8">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-brand-primary hover:text-brand-dark transition">Daftar sekarang</a>
                </p>
            </div>
        </div>
        
    </div>

</body>
</html>