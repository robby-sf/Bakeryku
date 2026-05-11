<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Sliced Bread Bakery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#FAF8F5] font-sans antialiased text-[#452A1B] min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-[#BA8E60]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-[#855333]/10 rounded-full blur-3xl"></div>

    <div class="w-full max-w-md px-6 relative z-10">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#855333] text-[#E8C39E] text-3xl mb-4 shadow-lg">
                <i class="fa-solid fa-croissant"></i>
            </div>
            <h1 class="font-heading text-3xl font-bold tracking-wide uppercase">Admin Portal</h1>
            <p class="text-sm text-gray-500 mt-2">Silakan masuk untuk mengelola Sliced Bread Bakery.</p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-[#EAE2D6]">
            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <p class="font-bold">Login gagal.</p>
                    <p class="mt-1">{{ $errors->first() }}</p>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-bold text-[#855333] mb-1.5">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-regular fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" id="email" required autofocus
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-[#EAE2D6] focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] outline-none transition duration-200 bg-[#FAF8F5] text-sm font-medium text-[#452A1B]" 
                            placeholder="admin@slicedbread.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-[#855333] mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" required
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-[#EAE2D6] focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] outline-none transition duration-200 bg-[#FAF8F5] text-sm font-medium text-[#452A1B]" 
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between mt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#855333] focus:ring-[#855333] w-4 h-4">
                        <span class="text-sm text-gray-600 font-medium">Ingat Saya</span>
                    </label>
                    <a href="#" class="text-sm font-bold text-[#BA8E60] hover:text-[#855333] transition-colors">Lupa Password?</a>
                </div>

                <button type="submit" class="w-full bg-[#452A1B] text-white font-bold py-3.5 rounded-xl hover:bg-[#5C3925] transition-colors shadow-sm mt-6 flex justify-center items-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk Dashboard
                </button>
            </form>
            
            <div class="mt-6 text-center border-t border-[#EAE2D6] pt-5">
                <p class="text-sm text-gray-500">Belum punya akses? 
                    <a href="{{ route('admin.register') }}" class="font-bold text-[#855333] hover:text-[#452A1B] transition-colors">Daftar di sini</a>
                </p>
            </div>
        </div>

        <p class="text-center text-sm text-gray-500 mt-8">
            &copy; {{ date('Y') }} Sliced Bread Bakery. All rights reserved.
        </p>

    </div>

</body>
</html>