<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register | Sliced Bread Bakery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#FAF8F5] font-sans antialiased text-[#452A1B] min-h-screen flex items-center justify-center relative overflow-hidden py-10">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-[#BA8E60]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-[#855333]/10 rounded-full blur-3xl"></div>

    <div class="w-full max-w-lg px-6 relative z-10">
        
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#855333] text-[#E8C39E] text-2xl mb-3 shadow-lg">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h1 class="font-heading text-2xl font-bold tracking-wide uppercase">Registrasi Admin</h1>
            <p class="text-sm text-gray-500 mt-1">Buat kredensial akses untuk staf internal Sliced Bread Bakery.</p>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-[#EAE2D6]">
            <form method="POST" action="{{ route('admin.register') }}" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-bold text-[#452A1B] mb-1.5">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-regular fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="name" id="name" required autofocus
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-[#EAE2D6] focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] outline-none transition duration-200 bg-[#FAF8F5] text-sm font-medium text-[#452A1B]" 
                                placeholder="Cth: Budi Santoso">
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-bold text-[#452A1B] mb-1.5">Email Kerja</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-regular fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" id="email" required
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-[#EAE2D6] focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] outline-none transition duration-200 bg-[#FAF8F5] text-sm font-medium text-[#452A1B]" 
                                placeholder="nama@slicedbread.com">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-[#452A1B] mb-1.5">Password Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400 text-xs"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="w-full pl-9 pr-4 py-3 rounded-xl border border-[#EAE2D6] focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] outline-none transition duration-200 bg-[#FAF8F5] text-sm font-medium text-[#452A1B]" 
                                placeholder="Min. 8 karakter">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-[#452A1B] mb-1.5">Ulangi Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-shield-halved text-gray-400 text-xs"></i>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full pl-9 pr-4 py-3 rounded-xl border border-[#EAE2D6] focus:border-[#BA8E60] focus:ring-1 focus:ring-[#BA8E60] outline-none transition duration-200 bg-[#FAF8F5] text-sm font-medium text-[#452A1B]" 
                                placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#452A1B] text-white font-bold py-3.5 rounded-xl hover:bg-[#5C3925] transition-colors shadow-sm mt-6 flex justify-center items-center gap-2">
                    <i class="fa-solid fa-user-check"></i> Buat Akun Admin
                </button>
            </form>
        </div>
        
        <div class="text-center mt-6">
            <a href="{{ route('admin.login') }}" class="text-sm font-bold text-[#855333] hover:text-[#452A1B] transition-colors">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Login
            </a>
        </div>

    </div>

</body>
</html>