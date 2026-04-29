<header class="bg-brand-light sticky top-0 z-50 shadow-sm">
    <div class="container mx-auto px-4 md:px-6 py-4 flex items-center">
        
        <div class="flex-1 flex justify-start">
            <a href="/" class="flex items-center gap-3 cursor-pointer">
                <div class="bg-brand-primary text-white p-2 md:p-3 rounded-lg flex flex-col justify-center items-center">
                    <h1 class="font-heading font-bold text-lg md:text-xl leading-none tracking-wider">Slice Bread </h1>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-widest mt-1">Bakery</span>
                </div>
            </a>
        </div>
        
        <nav class="hidden md:flex gap-8 font-medium text-sm tracking-wide items-center justify-center">
            <a href="/" class="border-b-2 transition duration-300 py-1 {{ request()->is('/') ? 'text-brand-primary border-brand-primary' : 'text-brand-dark border-transparent hover:text-brand-primary hover:border-brand-primary' }}">
                HOME
            </a>
            <a href="/menu" class="border-b-2 transition duration-300 py-1 {{ request()->is('menu') ? 'text-brand-primary border-brand-primary' : 'text-brand-dark border-transparent hover:text-brand-primary hover:border-brand-primary' }}">
                MENU
            </a>
            <a href="/stores" class="border-b-2 transition duration-300 py-1 {{ request()->is('stores') ? 'text-brand-primary border-brand-primary' : 'text-brand-dark border-transparent hover:text-brand-primary hover:border-brand-primary' }}">
                STORES
            </a>
            <a href="/promo" class="border-b-2 transition duration-300 py-1 {{ request()->is('promo') ? 'text-brand-primary border-brand-primary' : 'text-brand-dark border-transparent hover:text-brand-primary hover:border-brand-primary' }}">
                PROMO
            </a>
        </nav>
        
        <div class="flex-1 flex items-center justify-end gap-4 md:gap-6">
            <button aria-label="Search" class="hover:text-brand-primary transition duration-300">
                <i class="fa-solid fa-magnifying-glass text-lg md:text-xl"></i>
            </button>
            
            @if(Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'user')
            <div class="relative hidden md:block">
                <button id="user-menu-btn" class="flex items-center gap-2 bg-brand-primary hover:bg-brand-dark text-white text-sm font-semibold py-2 px-4 rounded-full transition duration-300 shadow-md">
                    <i class="fa-solid fa-user"></i>
                    {{ Auth::guard('user')->user()->name }}
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </button>
                <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fa-solid fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fa-solid fa-user mr-2"></i> Profile
                    </a>
                    <hr class="border-gray-100 my-1">
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
            @elseif(Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin')
            <div class="relative hidden md:block">
                <button id="admin-menu-btn" class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2 px-4 rounded-full transition duration-300 shadow-md">
                    <i class="fa-solid fa-shield-alt"></i>
                    {{ Auth::guard('admin')->user()->name }}
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </button>
                <div id="admin-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fa-solid fa-tachometer-alt mr-2"></i> Admin Dashboard
                    </a>
                    <hr class="border-gray-100 my-1">
                    <form method="POST" action="{{ route('admin.logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
            @else
            <a href="/login" class="hidden md:block bg-brand-primary hover:bg-brand-dark text-white text-sm font-semibold py-2 px-6 rounded-full transition duration-300 shadow-md whitespace-nowrap">
                LOGIN/SIGN UP
            </a>
            @endif

            <button id="mobile-menu-btn" aria-label="Menu" class="block md:hidden text-brand-dark hover:text-brand-primary transition duration-300 focus:outline-none ml-2">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </div>
        
    </div>
    
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-inner absolute w-full left-0">
        <div class="flex flex-col px-4 py-4 space-y-4 font-medium text-sm">
            <a href="/" class="block transition {{ request()->is('/') ? 'text-brand-primary font-bold' : 'text-brand-dark hover:text-brand-primary' }}">HOME</a>
            <a href="/menu" class="block transition {{ request()->is('menu') ? 'text-brand-primary font-bold' : 'text-brand-dark hover:text-brand-primary' }}">MENU</a>
            <a href="/stores" class="block transition {{ request()->is('stores') ? 'text-brand-primary font-bold' : 'text-brand-dark hover:text-brand-primary' }}">STORES</a>
            <a href="/promo" class="block transition {{ request()->is('promo') ? 'text-brand-primary font-bold' : 'text-brand-dark hover:text-brand-primary' }}">PROMO</a>
            <hr class="border-gray-100">
            
            @if(Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'user')
            <div class="space-y-2">
                <p class="text-brand-primary font-semibold">{{ Auth::guard('user')->user()->name }}</p>
                <a href="{{ route('dashboard') }}" class="block bg-brand-primary hover:bg-brand-dark text-white text-sm font-semibold py-3 px-6 rounded-full transition duration-300 shadow-md w-full text-center">
                    <i class="fa-solid fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="{{ route('profile') }}" class="block bg-gray-100 hover:bg-gray-200 text-brand-dark text-sm font-semibold py-3 px-6 rounded-full transition duration-300 w-full text-center">
                    <i class="fa-solid fa-user mr-2"></i> Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-3 px-6 rounded-full transition duration-300 shadow-md">
                        <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
            @elseif(Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin')
            <div class="space-y-2">
                <p class="text-red-600 font-semibold">{{ Auth::guard('admin')->user()->name }} (Admin)</p>
                <a href="{{ route('admin.dashboard') }}" class="block bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-3 px-6 rounded-full transition duration-300 shadow-md w-full text-center">
                    <i class="fa-solid fa-tachometer-alt mr-2"></i> Admin Dashboard
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-3 px-6 rounded-full transition duration-300 shadow-md">
                        <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
            @else
            <a href="/login" class="block bg-brand-primary hover:bg-brand-dark text-white text-sm font-semibold py-3 px-6 rounded-full transition duration-300 shadow-md w-full text-center no-underline">
                LOGIN / SIGN UP
            </a>
            @endif
        </div>
    </div>
</header>
