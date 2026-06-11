<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Slice Bread Bakery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-brand-light font-body antialiased text-brand-dark">

    <div class="min-h-screen flex">
        
        {{-- Left: Visual Panel --}}
        <div class="hidden lg:flex lg:w-1/2 relative bg-black overflow-hidden">
            <img src="{{ Storage::url('products/Roll Cake.jpg') }}" 
                 alt="Slice Bread Bakery" 
                 class="absolute inset-0 w-full h-full object-cover opacity-70 transition-transform duration-[15000ms] ease-linear hover:scale-110">
            
            {{-- Gradient overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/80 via-brand-dark/30 to-transparent"></div>

            <div class="absolute inset-0 flex flex-col justify-end px-12 xl:px-16 pb-16 z-10 text-white">
                <div class="auth-animate" style="--delay: 0.2s">
                    <h1 class="font-heading text-4xl xl:text-5xl font-bold mb-4 leading-tight">Kembali ke<br>Rasa Favoritmu.</h1>
                </div>
                <div class="auth-animate" style="--delay: 0.4s">
                    <p class="text-base xl:text-lg text-white/80 max-w-md leading-relaxed">Masuk untuk menikmati promo eksklusif, melacak pesanan, dan menyimpan menu bakery favoritmu.</p>
                </div>
                {{-- Trust badges --}}
                <div class="flex items-center gap-6 mt-8 auth-animate" style="--delay: 0.6s">
                    <div class="flex items-center gap-2 text-white/60 text-xs">
                        <i class="fa-solid fa-shield-halved text-sm"></i>
                        <span>Data Aman</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/60 text-xs">
                        <i class="fa-solid fa-bolt text-sm"></i>
                        <span>Proses Cepat</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/60 text-xs">
                        <i class="fa-solid fa-gift text-sm"></i>
                        <span>Promo Eksklusif</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Form Panel --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 md:p-16 bg-white relative overflow-hidden">
            {{-- Decorative circles --}}
            <div class="absolute top-[-100px] right-[-100px] w-[300px] h-[300px] rounded-full bg-brand-primary/[0.03]"></div>
            <div class="absolute bottom-[-80px] left-[-80px] w-[200px] h-[200px] rounded-full bg-brand-primary/[0.03]"></div>

            <div class="w-full max-w-md relative z-10">
                
                <div class="text-center mb-10 auth-animate" style="--delay: 0.1s">
                    <a href="/" class="inline-flex flex-col items-center group">
                        <span class="font-heading text-2xl font-bold text-brand-primary italic group-hover:text-brand-dark transition-colors duration-300">Slice Bread</span>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-6 h-px bg-brand-primary/30"></span>
                            <span class="text-[7px] uppercase tracking-[0.2em] text-brand-primary/50 font-semibold">Bakery & Pastry</span>
                            <span class="w-6 h-px bg-brand-primary/30"></span>
                        </div>
                    </a>
                    <h2 class="text-2xl font-bold text-brand-dark mt-6">Selamat Datang Kembali</h2>
                    <p class="text-gray-500 text-sm mt-1">Silakan masukkan email dan password kamu.</p>
                    
                    @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mt-4 flex items-center gap-2 text-sm" role="alert">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif
                </div>

                <form method="POST" action="/login" class="space-y-6">
                    @csrf
                    
                    @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl auth-animate" style="--delay: 0.1s" role="alert">
                        <p class="text-red-700 font-semibold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-exclamation-circle"></i>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                                @if (!$loop->last)<br>@endif
                            @endforeach
                        </p>
                    </div>
                    @endif

                    <div class="auth-animate" style="--delay: 0.2s">
                        <label for="email" class="block text-sm font-semibold text-brand-dark mb-1.5">Email</label>
                        <div class="relative group/input">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-regular fa-envelope text-gray-400 group-focus-within/input:text-brand-primary transition-colors duration-300"></i>
                            </div>
                            <input type="email" name="email" id="email" required autofocus value="{{ old('email') }}"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border transition-all duration-300 focus:ring-2 outline-none bg-brand-light/50 @error('email') border-red-500 focus:border-red-500 focus:ring-red-200 @else border-gray-200 focus:border-brand-primary focus:ring-brand-primary/20 hover:border-gray-300 @enderror" 
                                placeholder="nama@email.com">
                        </div>
                    </div>

                    <div class="auth-animate" style="--delay: 0.3s">
                        <label for="password" class="block text-sm font-semibold text-brand-dark mb-1.5">Password</label>
                        <div class="relative group/input">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400 group-focus-within/input:text-brand-primary transition-colors duration-300"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="w-full pl-10 pr-12 py-3 rounded-xl border transition-all duration-300 focus:ring-2 outline-none bg-brand-light/50 @error('password') border-red-500 focus:border-red-500 focus:ring-red-200 @else border-gray-200 focus:border-brand-primary focus:ring-brand-primary/20 hover:border-gray-300 @enderror" 
                                placeholder="••••••••">
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand-primary transition-colors duration-300">
                                <i class="fa-regular fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm auth-animate" style="--delay: 0.4s">
                        <label class="flex items-center gap-2 cursor-pointer group/check">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-brand-primary focus:ring-brand-primary w-4 h-4 transition-all duration-200">
                            <span class="text-gray-600 font-medium group-hover/check:text-brand-dark transition-colors duration-200">Ingat Saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="font-bold text-brand-primary hover:text-brand-dark transition-colors duration-300">Lupa Password?</a>
                        @endif
                    </div>

                    <div class="auth-animate" style="--delay: 0.5s">
                        <button type="submit" class="w-full bg-brand-primary text-white font-bold py-3.5 rounded-full hover:bg-brand-dark transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5 active:scale-[0.98]">
                            Masuk
                        </button>
                    </div>
                    

                </form>

                <p class="text-center text-sm text-gray-600 mt-8 auth-animate" style="--delay: 0.7s">
                    Belum punya akun? 
                    <a href="/register" class="font-bold text-brand-primary hover:text-brand-dark transition-colors duration-300">Daftar sekarang</a>
                </p>
            </div>
        </div>
        
    </div>

    <style>
        .auth-animate {
            opacity: 0;
            transform: translateY(20px);
            animation: authFadeIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            animation-delay: var(--delay, 0s);
        }
        @keyframes authFadeIn {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const toggle = document.getElementById('togglePassword');
            const pwd = document.getElementById('password');
            const eye = document.getElementById('eyeIcon');
            if (toggle && pwd) {
                toggle.addEventListener('click', () => {
                    const isPassword = pwd.type === 'password';
                    pwd.type = isPassword ? 'text' : 'password';
                    eye.className = isPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
                });
            }

            // Input focus effect — subtle label color
            document.querySelectorAll('input[type="email"], input[type="password"]').forEach(input => {
                input.addEventListener('focus', () => {
                    const label = input.closest('div').previousElementSibling;
                    if (label && label.tagName === 'LABEL') label.classList.add('text-brand-primary');
                });
                input.addEventListener('blur', () => {
                    const label = input.closest('div').previousElementSibling;
                    if (label && label.tagName === 'LABEL') label.classList.remove('text-brand-primary');
                });
            });
        });
    </script>

</body>
</html>