{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') | Ananda Bakery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Sembunyikan scrollbar untuk menu di versi mobile --}}
    @stack('styles')
    <style>
        .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
        .hide-scroll-bar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-[#FAF8F5] font-sans antialiased text-gray-800 min-h-screen flex flex-col">

    @include('components.admin.navbar')

    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        @hasSection('header_title')
        <div class="mb-6 flex justify-between items-end">
            <div>
                <h1 class="font-heading text-2xl font-bold text-[#452A1B]">@yield('header_title')</h1>
                <p class="text-sm text-gray-500 mt-1">@yield('header_subtitle')</p>
            </div>
            @yield('header_actions') </div>
        @endif

        @yield('content')

    </main>

    @stack('scripts')
</body>
</html>