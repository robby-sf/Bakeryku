<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Slice Bread Bakery</title>
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
            <img src="{{ Storage::url('products/Roti Tawar.jpg') }}" 
                 alt="Slice Bread Bakery" 
                 class="absolute inset-0 w-full h-full object-cover opacity-60 transition-transform duration-[15000ms] ease-linear hover:scale-110">
            
            {{-- Gradient overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/80 via-brand-dark/30 to-transparent"></div>

            <div class="absolute inset-0 flex flex-col justify-end px-12 xl:px-16 pb-16 z-10 text-white">
                <div class="auth-animate" style="--delay: 0.2s">
                    <span class="inline-flex items-center gap-2 bg-brand-primary/80 backdrop-blur-sm text-white text-xs font-bold px-3.5 py-1.5 rounded-full w-max mb-4 uppercase tracking-wider">
                        <i class="fa-solid fa-sparkles text-amber-300"></i> Anggota Baru
                    </span>
                </div>
                <div class="auth-animate" style="--delay: 0.4s">
                    <h1 class="font-heading text-4xl xl:text-5xl font-bold mb-4 leading-tight">Awali Hari<br>dengan yang Manis.</h1>
                </div>
                <div class="auth-animate" style="--delay: 0.6s">
                    <p class="text-base xl:text-lg text-white/80 max-w-md leading-relaxed">Buat akun sekarang untuk kemudahan pemesanan dan melacak menu favoritmu.</p>
                </div>
                {{-- Benefits --}}
                <div class="flex flex-wrap items-center gap-6 mt-8 auth-animate" style="--delay: 0.8s">
                    <div class="flex items-center gap-2 text-white/60 text-xs">
                        <div class="w-6 h-6 rounded-full bg-white/10 flex items-center justify-center"><i class="fa-solid fa-shield-halved text-[9px]"></i></div>
                        <span>Data Aman</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/60 text-xs">
                        <div class="w-6 h-6 rounded-full bg-white/10 flex items-center justify-center"><i class="fa-solid fa-bolt text-[9px]"></i></div>
                        <span>Proses Cepat</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/60 text-xs">
                        <div class="w-6 h-6 rounded-full bg-white/10 flex items-center justify-center"><i class="fa-solid fa-truck-fast text-[9px]"></i></div>
                        <span>Pesan Mudah</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Form Panel --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 bg-white overflow-y-auto relative">
            {{-- Decorative --}}
            <div class="absolute top-[-100px] right-[-100px] w-[300px] h-[300px] rounded-full bg-brand-primary/[0.03]"></div>
            <div class="absolute bottom-[-80px] left-[-80px] w-[200px] h-[200px] rounded-full bg-brand-primary/[0.03]"></div>

            <div class="w-full max-w-md py-8 relative z-10">
                
                <div class="text-center mb-8 auth-animate" style="--delay: 0.1s">
                    <a href="/" class="inline-flex flex-col items-center group">
                        <span class="font-heading text-2xl font-bold text-brand-primary italic group-hover:text-brand-dark transition-colors duration-300">Slice Bread</span>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-6 h-px bg-brand-primary/30"></span>
                            <span class="text-[7px] uppercase tracking-[0.2em] text-brand-primary/50 font-semibold">Bakery & Pastry</span>
                            <span class="w-6 h-px bg-brand-primary/30"></span>
                        </div>
                    </a>
                    <h2 class="text-2xl font-bold text-brand-dark mt-6">Daftar Akun Baru</h2>
                    <p class="text-gray-500 text-sm mt-1">Lengkapi data di bawah ini untuk bergabung.</p>
                </div>

                <form method="POST" action="/register" class="space-y-5">
                    @csrf
                    
                    @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl auth-animate" style="--delay: 0.1s" role="alert">
                        <p class="text-red-700 font-semibold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-exclamation-circle"></i>
                            <span>Terjadi kesalahan saat mendaftar:</span>
                        </p>
                        <ul class="mt-2 ml-6 text-red-600 text-xs space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Name --}}
                    <div class="auth-animate" style="--delay: 0.15s">
                        <label for="name" class="block text-sm font-semibold text-brand-dark mb-1.5 transition-colors duration-300">Nama Lengkap</label>
                        <div class="relative group/input">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-regular fa-user text-gray-400 group-focus-within/input:text-brand-primary transition-colors duration-300"></i>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/20 outline-none transition-all duration-300 bg-brand-light/50 hover:border-gray-300" 
                                placeholder="Cth: Budi Santoso">
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation text-[9px]"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="auth-animate" style="--delay: 0.2s">
                        <label for="email" class="block text-sm font-semibold text-brand-dark mb-1.5 transition-colors duration-300">Email</label>
                        <div class="relative group/input">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-regular fa-envelope text-gray-400 group-focus-within/input:text-brand-primary transition-colors duration-300"></i>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/20 outline-none transition-all duration-300 bg-brand-light/50 hover:border-gray-300" 
                                placeholder="nama@email.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation text-[9px]"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="auth-animate" style="--delay: 0.25s">
                        <label for="password" class="block text-sm font-semibold text-brand-dark mb-1.5 transition-colors duration-300">Password</label>
                        <div class="relative group/input">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400 group-focus-within/input:text-brand-primary transition-colors duration-300"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="w-full pl-10 pr-12 py-3 rounded-xl border border-gray-200 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/20 outline-none transition-all duration-300 bg-brand-light/50 hover:border-gray-300" 
                                placeholder="Minimal 8 karakter">
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand-primary transition-colors duration-300">
                                <i class="fa-regular fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation text-[9px]"></i> {{ $message }}</p>
                        @enderror
                        {{-- Password strength indicator --}}
                        <div class="flex gap-1 mt-2" id="strengthBars">
                            <div class="h-1 flex-1 rounded-full bg-gray-200 transition-colors duration-300" id="str1"></div>
                            <div class="h-1 flex-1 rounded-full bg-gray-200 transition-colors duration-300" id="str2"></div>
                            <div class="h-1 flex-1 rounded-full bg-gray-200 transition-colors duration-300" id="str3"></div>
                            <div class="h-1 flex-1 rounded-full bg-gray-200 transition-colors duration-300" id="str4"></div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1" id="strengthText">Masukkan minimal 8 karakter</p>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="auth-animate" style="--delay: 0.3s">
                        <label for="password_confirmation" class="block text-sm font-semibold text-brand-dark mb-1.5 transition-colors duration-300">Konfirmasi Password</label>
                        <div class="relative group/input">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-shield-halved text-gray-400 group-focus-within/input:text-brand-primary transition-colors duration-300"></i>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full pl-10 pr-12 py-3 rounded-xl border border-gray-200 focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/20 outline-none transition-all duration-300 bg-brand-light/50 hover:border-gray-300" 
                                placeholder="Ulangi password">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-circle-check text-green-500 text-sm opacity-0 transition-opacity duration-300" id="matchIcon"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="flex items-start mt-2 auth-animate" style="--delay: 0.35s">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required
                                class="w-4 h-4 rounded border-gray-300 text-brand-primary focus:ring-brand-primary cursor-pointer transition-all duration-200">
                        </div>
                        <div class="ml-2 text-sm">
                            <label for="terms" class="text-gray-600 font-medium cursor-pointer leading-relaxed">
                                Saya setuju dengan <a href="#" class="text-brand-primary hover:text-brand-dark font-bold transition-colors duration-300">Syarat & Ketentuan</a> serta <a href="#" class="text-brand-primary hover:text-brand-dark font-bold transition-colors duration-300">Kebijakan Privasi</a>.
                            </label>
                        </div>
                    </div>

                    <div class="auth-animate" style="--delay: 0.4s">
                        <button type="submit" class="w-full bg-brand-primary text-white font-bold py-3.5 rounded-full hover:bg-brand-dark transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5 active:scale-[0.98] mt-4">
                            Daftar Sekarang
                        </button>
                    </div>
                    

                </form>

                <p class="text-center text-sm text-gray-600 mt-8 auth-animate" style="--delay: 0.55s">
                    Sudah punya akun? 
                    <a href="/login" class="font-bold text-brand-primary hover:text-brand-dark transition-colors duration-300">Masuk di sini</a>
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

            // Password strength indicator
            const bars = [document.getElementById('str1'), document.getElementById('str2'), document.getElementById('str3'), document.getElementById('str4')];
            const strengthText = document.getElementById('strengthText');
            const colors = ['bg-red-400', 'bg-orange-400', 'bg-yellow-400', 'bg-green-500'];
            const labels = ['Lemah', 'Cukup', 'Baik', 'Kuat'];

            if (pwd) {
                pwd.addEventListener('input', () => {
                    const val = pwd.value;
                    let score = 0;
                    if (val.length >= 8) score++;
                    if (/[A-Z]/.test(val)) score++;
                    if (/[0-9]/.test(val)) score++;
                    if (/[^A-Za-z0-9]/.test(val)) score++;

                    bars.forEach((bar, i) => {
                        bar.className = 'h-1 flex-1 rounded-full transition-colors duration-300';
                        if (i < score) {
                            bar.classList.add(colors[score - 1]);
                        } else {
                            bar.classList.add('bg-gray-200');
                        }
                    });

                    if (val.length === 0) {
                        strengthText.textContent = 'Masukkan minimal 8 karakter';
                        strengthText.className = 'text-[10px] text-gray-400 mt-1';
                    } else {
                        strengthText.textContent = 'Kekuatan: ' + (labels[score - 1] || 'Sangat Lemah');
                        strengthText.className = 'text-[10px] mt-1 font-medium ' + (score >= 3 ? 'text-green-600' : score >= 2 ? 'text-yellow-600' : 'text-red-500');
                    }
                });
            }

            // Password match indicator
            const confirmPwd = document.getElementById('password_confirmation');
            const matchIcon = document.getElementById('matchIcon');
            if (confirmPwd && pwd && matchIcon) {
                confirmPwd.addEventListener('input', () => {
                    if (confirmPwd.value.length > 0 && confirmPwd.value === pwd.value) {
                        matchIcon.style.opacity = '1';
                    } else {
                        matchIcon.style.opacity = '0';
                    }
                });
            }

            // Input focus label color
            document.querySelectorAll('input:not([type="checkbox"])').forEach(input => {
                input.addEventListener('focus', () => {
                    const wrapper = input.closest('div').parentElement;
                    const label = wrapper?.querySelector('label');
                    if (label) label.classList.add('text-brand-primary');
                });
                input.addEventListener('blur', () => {
                    const wrapper = input.closest('div').parentElement;
                    const label = wrapper?.querySelector('label');
                    if (label) label.classList.remove('text-brand-primary');
                });
            });
        });
    </script>

</body>
</html>