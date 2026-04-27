{{-- resources/views/components/admin/navbar.blade.php --}}
<div class="w-full shadow-sm relative z-50">
    
    <div class="bg-[#855333] text-white relative z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <div class="flex flex-col justify-center">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-croissant text-2xl text-[#E8C39E]"></i> 
                        <span class="font-heading text-2xl font-bold tracking-wide uppercase">Slice Bread Bakery</span>
                    </div>
                    <span class="text-xs text-gray-200 tracking-wider">Admin Dashboard</span>
                </div>

                <div class="flex items-center gap-6">
                    
                    <div class="relative">
                        <button id="notif-btn" class="relative p-2 text-white hover:text-gray-200 transition focus:outline-none">
                            <i class="fa-regular fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-[#DE5B6D] text-[10px] font-bold text-white shadow-sm border border-[#855333]">3</span>
                        </button>

                        <div id="notif-menu" class="hidden absolute right-0 mt-3 w-80 bg-white z-50 rounded-xl shadow-lg border border-gray-100 overflow-hidden transform origin-top-right transition-all">
                            <div class="bg-[#FAF8F5] px-4 py-3 border-b border-[#EAE2D6] flex justify-between items-center">
                                <span class="font-bold text-[#452A1B] text-sm">Notifikasi Baru</span>
                                <span class="text-xs bg-[#855333] text-white px-2 py-0.5 rounded-full">3</span>
                            </div>
                            
                            <div class="max-h-72 overflow-y-auto">
                                <a href="#" class="block px-4 py-3 hover:bg-[#FAF8F5] border-b border-gray-50 transition group">
                                    <p class="text-sm text-[#452A1B] font-medium group-hover:text-[#855333]">Pesanan #4521 berhasil dibayar.</p>
                                    <p class="text-xs text-gray-400 mt-1"><i class="fa-regular fa-clock mr-1"></i>2 menit yang lalu</p>
                                </a>
                                <a href="#" class="block px-4 py-3 hover:bg-[#FAF8F5] border-b border-gray-50 transition group">
                                    <p class="text-sm text-[#452A1B] font-medium group-hover:text-[#855333]">Ulasan baru pada produk Dubai Series.</p>
                                    <p class="text-xs text-gray-400 mt-1"><i class="fa-regular fa-clock mr-1"></i>1 jam yang lalu</p>
                                </a>
                                <a href="#" class="block px-4 py-3 hover:bg-[#FAF8F5] transition group">
                                    <p class="text-sm text-[#452A1B] font-medium group-hover:text-[#855333]">Stok Croissant Deluxe hampir habis.</p>
                                    <p class="text-xs text-gray-400 mt-1"><i class="fa-regular fa-clock mr-1"></i>Kemarin</p>
                                </a>
                            </div>
                            
                            <a href="{{ route('admin.notifications') ?? '#' }}" class="block text-center px-4 py-3 bg-[#EAE2D6]/30 text-sm text-[#855333] hover:bg-[#EAE2D6] font-bold transition border-t border-[#EAE2D6]">
                                Lihat Semua Notifikasi
                            </a>
                        </div>
                    </div>

                    <div class="relative border-l border-white/20 pl-6">
                        <button id="profile-btn" class="flex items-center gap-3 cursor-pointer hover:opacity-80 transition focus:outline-none text-left">
                            <div class="hidden md:block">
                                <p class="text-sm font-bold leading-tight">Store Manager</p>
                                <p class="text-xs text-gray-300 leading-tight">admin@slicebread.com</p>
                            </div>
                            <div class="h-10 w-10 rounded-full bg-[#BA8E60] flex items-center justify-center text-white font-bold text-lg shadow-inner">
                                A
                            </div>
                            <i class="fa-solid fa-chevron-down text-xs text-gray-300 ml-1 hidden md:block"></i>
                        </button>

                        <div id="profile-menu" class="hidden absolute right-0 mt-4 w-56 bg-white z-50 rounded-xl shadow-lg border border-gray-100 overflow-hidden transform origin-top-right transition-all">
                            <div class="md:hidden px-4 py-3 border-b border-[#EAE2D6] bg-[#FAF8F5]">
                                <p class="text-sm font-bold text-[#452A1B]">Store Manager</p>
                                <p class="text-xs text-gray-500 truncate">admin@slicebread.com</p>
                            </div>
                            
                            <div class="py-2">
                                <a href="{{ route('admin.profile') ?? '#' }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F5] hover:text-[#855333] transition font-medium">
                                    <i class="fa-regular fa-circle-user w-4 text-center"></i> Profil Saya
                                </a>
                                <a href="{{ route('admin.settings') ?? '#' }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F5] hover:text-[#855333] transition font-medium">
                                    <i class="fa-solid fa-gear w-4 text-center"></i> Pengaturan Akun
                                </a>
                            </div>
                            
                            <div class="border-t border-[#EAE2D6] py-2">
                                <form method="POST" action="{{ route('logout') ?? '#' }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-3 px-4 py-2 text-sm text-[#DE5B6D] hover:bg-red-50 hover:text-red-700 transition font-bold text-left">
                                        <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="bg-[#FAF8F5] pt-6 pb-2 border-b border-gray-200 relative z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="bg-[#EAE2D6] rounded-xl flex items-center justify-between p-1.5 overflow-x-auto hide-scroll-bar">
                
                <a href="{{ route('admin.dashboard') ?? '#' }}" 
                   class="flex-1 min-w-[100px] text-center py-2.5 rounded-lg transition-colors text-sm 
                   {{ request()->routeIs('admin.dashboard') ? 'bg-[#855333] text-white font-bold shadow-md' : 'text-[#452A1B] font-medium hover:bg-[#DCD0C0]' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.products') ?? '#' }}" 
                   class="flex-1 min-w-[100px] text-center py-2.5 rounded-lg transition-colors text-sm 
                   {{ request()->routeIs('admin.products') ? 'bg-[#855333] text-white font-bold shadow-md' : 'text-[#452A1B] font-medium hover:bg-[#DCD0C0]' }}">
                    Products
                </a>

                <a href="{{ route('admin.promos') ?? '#' }}" 
                   class="flex-1 min-w-[100px] text-center py-2.5 rounded-lg transition-colors text-sm 
                   {{ request()->routeIs('admin.promos') ? 'bg-[#855333] text-white font-bold shadow-md' : 'text-[#452A1B] font-medium hover:bg-[#DCD0C0]' }}">
                    Promos
                </a>

                <a href="{{ route('admin.reviews') ?? '#' }}" 
                   class="flex-1 min-w-[100px] text-center py-2.5 rounded-lg transition-colors text-sm 
                   {{ request()->routeIs('admin.reviews') ? 'bg-[#855333] text-white font-bold shadow-md' : 'text-[#452A1B] font-medium hover:bg-[#DCD0C0]' }}">
                    Reviews
                </a>

                <a href="{{ route('admin.settings') ?? '#' }}" 
                   class="flex-1 min-w-[100px] text-center py-2.5 rounded-lg transition-colors text-sm 
                   {{ request()->routeIs('admin.settings') ? 'bg-[#855333] text-white font-bold shadow-md' : 'text-[#452A1B] font-medium hover:bg-[#DCD0C0]' }}">
                    Settings
                </a>

            </nav>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notifBtn = document.getElementById('notif-btn');
        const notifMenu = document.getElementById('notif-menu');
        
        const profileBtn = document.getElementById('profile-btn');
        const profileMenu = document.getElementById('profile-menu');

        notifBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notifMenu.classList.toggle('hidden');
            profileMenu.classList.add('hidden'); 
        });

        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
            notifMenu.classList.add('hidden'); 
        });

        document.addEventListener('click', function(e) {
            if (!notifMenu.contains(e.target) && !notifBtn.contains(e.target)) {
                notifMenu.classList.add('hidden');
            }
            if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                profileMenu.classList.add('hidden');
            }
        });
    });
</script>