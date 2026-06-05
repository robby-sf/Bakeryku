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
                    
                    @php
                        $unreadNotificationsCount = Auth::guard('admin')->user()->unreadNotifications()->count();
                        $recentNotifications = Auth::guard('admin')->user()->notifications()->latest()->take(5)->get();
                    @endphp

                    <div class="relative">
                        <button id="notif-btn" class="relative p-2 text-white hover:text-gray-200 transition focus:outline-none">
                            <i class="fa-regular fa-bell text-xl"></i>
                            <span id="notif-badge" class="{{ $unreadNotificationsCount > 0 ? 'flex' : 'hidden' }} absolute top-1 right-1 h-4 min-w-[1rem] items-center justify-center rounded-full bg-[#DE5B6D] px-1 text-[10px] font-bold leading-none text-white shadow-sm border border-[#855333]">
                                {{ $unreadNotificationsCount > 99 ? '99+' : $unreadNotificationsCount }}
                            </span>
                        </button>

                        <div id="notif-menu" class="hidden absolute right-0 mt-3 w-80 bg-white z-50 rounded-xl shadow-lg border border-gray-100 overflow-hidden transform origin-top-right transition-all">
                            <div class="bg-[#FAF8F5] px-4 py-3 border-b border-[#EAE2D6] flex justify-between items-center">
                                <div>
                                    <span class="font-bold text-[#452A1B] text-sm">Notifikasi</span>
                                    <p id="notif-unread-label" class="text-xs text-gray-500">{{ $unreadNotificationsCount }} belum dibaca</p>
                                </div>
                                <button id="notif-mark-all-btn" class="{{ $unreadNotificationsCount > 0 ? '' : 'hidden' }} text-xs font-bold text-[#855333] hover:text-[#452A1B] transition">Tandai Semua Dibaca</button>
                            </div>

                            <div id="notif-list" class="max-h-72 overflow-y-auto">
                                @forelse($recentNotifications as $notification)
                                    <button data-id="{{ $notification->id }}" class="notif-item w-full text-left block px-4 py-3 hover:bg-[#FAF8F5] border-b border-gray-50 transition group {{ $notification->is_read ? '' : 'bg-[#FFF5F5]' }}">
                                        <div class="flex justify-between items-start gap-3">
                                            <p class="text-sm text-[#452A1B] font-medium group-hover:text-[#855333]">{{ $notification->title }}</p>
                                            <span class="text-[10px] text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1 line-clamp-3">{{ $notification->message }}</p>
                                        @if(!$notification->is_read)
                                            <span class="mt-2 inline-flex items-center gap-1 px-2 py-1 rounded-full bg-[#DE5B6D]/10 text-[#DE5B6D] text-[10px] font-semibold">Baru</span>
                                        @endif
                                    </button>
                                @empty
                                    <div class="px-4 py-6 text-center text-gray-500 text-sm">
                                        Tidak ada notifikasi terbaru.
                                    </div>
                                @endforelse
                            </div>

                            <a href="{{ route('admin.notifications') }}" class="block text-center px-4 py-3 bg-[#EAE2D6]/30 text-sm text-[#855333] hover:bg-[#EAE2D6] font-bold transition border-t border-[#EAE2D6]">
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
                                <form method="POST" action="{{ route('admin.logout') }}">
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

                <a href="{{ route('admin.products.index') }}" 
                   class="flex-1 min-w-[120px] text-center py-2.5 rounded-lg transition-colors text-sm 
                   {{ request()->routeIs('admin.products*') ? 'bg-[#855333] text-white font-bold shadow-md' : 'text-[#452A1B] font-medium hover:bg-[#DCD0C0]' }}">
                    Products
                </a>

                <a href="{{ route('admin.reviews.index') }}" 
                   class="flex-1 min-w-[120px] text-center py-2.5 rounded-lg transition-colors text-sm 
                   {{ request()->routeIs('admin.reviews*') ? 'bg-[#855333] text-white font-bold shadow-md' : 'text-[#452A1B] font-medium hover:bg-[#DCD0C0]' }}">
                    Reviews
                </a>

                <a href="{{ route('admin.promos') }}" 
                   class="flex-1 min-w-[100px] text-center py-2.5 rounded-lg transition-colors text-sm 
                   {{ request()->routeIs('admin.promos*') ? 'bg-[#855333] text-white font-bold shadow-md' : 'text-[#452A1B] font-medium hover:bg-[#DCD0C0]' }}">
                    Promos
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
        const notifList = document.getElementById('notif-list');
        const notifBadge = document.getElementById('notif-badge');
        const notifUnreadLabel = document.getElementById('notif-unread-label');
        const markAllBtn = document.getElementById('notif-mark-all-btn');
        const profileBtn = document.getElementById('profile-btn');
        const profileMenu = document.getElementById('profile-menu');

        const unreadCountUrl = '{{ route('admin.notifications.unread-count') }}';
        const recentNotificationsUrl = '{{ route('admin.notifications.recent') }}';
        const markAllReadUrl = '{{ route('admin.notifications.mark-all-read') }}';
        const markReadUrlTemplate = '{{ route('admin.notifications.mark-read', ['notification' => '__ID__']) }}';

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, (char) => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;',
        }[char]));

        const updateBadge = (count) => {
            count = Number(count) || 0;

            if (notifUnreadLabel) {
                notifUnreadLabel.textContent = `${count} belum dibaca`;
            }

            if (markAllBtn) {
                markAllBtn.classList.toggle('hidden', count === 0);
            }

            if (!notifBadge) return;
            notifBadge.textContent = count > 99 ? '99+' : count;
            notifBadge.classList.toggle('hidden', count === 0);
            notifBadge.classList.toggle('flex', count > 0);
        };

        const renderNotifications = (notifications) => {
            if (!notifList) return;

            if (!notifications.length) {
                notifList.innerHTML = '<div class="px-4 py-6 text-center text-gray-500 text-sm">Tidak ada notifikasi terbaru.</div>';
                return;
            }

            notifList.innerHTML = notifications.map(notification => {
                const readClass = notification.is_read ? '' : 'bg-[#FFF5F5]';
                const badge = notification.is_read ? '' : '<span class="mt-2 inline-flex items-center gap-1 px-2 py-1 rounded-full bg-[#DE5B6D]/10 text-[#DE5B6D] text-[10px] font-semibold">Baru</span>';
                const time = new Date(notification.created_at).toLocaleString('id-ID', { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' });
                return `
                    <button data-id="${notification.id}" class="notif-item w-full text-left block px-4 py-3 hover:bg-[#FAF8F5] border-b border-gray-50 transition group ${readClass}">
                        <div class="flex justify-between items-start gap-3">
                            <p class="text-sm text-[#452A1B] font-medium group-hover:text-[#855333]">${escapeHtml(notification.title)}</p>
                            <span class="text-[10px] text-gray-400">${time}</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-3">${escapeHtml(notification.message)}</p>
                        ${badge}
                    </button>
                `;
            }).join('');
        };

        const fetchUnreadCount = async () => {
            try {
                const response = await fetch(unreadCountUrl, { headers: { Accept: 'application/json' } });
                const data = await response.json();
                updateBadge(data.unread_count ?? 0);
            } catch (error) {
                console.error('Unable to fetch unread count', error);
            }
        };

        const fetchRecentNotifications = async () => {
            try {
                const response = await fetch(recentNotificationsUrl, { headers: { Accept: 'application/json' } });
                const notifications = await response.json();
                renderNotifications(notifications);
            } catch (error) {
                console.error('Unable to fetch notifications', error);
            }
        };

        const markSelectedNotificationAsRead = async (id) => {
            if (!csrfToken) return;
            try {
                await fetch(markReadUrlTemplate.replace('__ID__', id), {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                });
                await fetchUnreadCount();
                await fetchRecentNotifications();
            } catch (error) {
                console.error('Unable to mark notification as read', error);
            }
        };

        const markAllNotificationsRead = async () => {
            if (!csrfToken) return;
            try {
                await fetch(markAllReadUrl, {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                });
                await fetchUnreadCount();
                await fetchRecentNotifications();
            } catch (error) {
                console.error('Unable to mark all notifications as read', error);
            }
        };

        if (notifBtn) {
            notifBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                notifMenu.classList.toggle('hidden');
                profileMenu.classList.add('hidden');
                fetchUnreadCount();
                fetchRecentNotifications();
            });
        }

        if (markAllBtn) {
            markAllBtn.addEventListener('click', function (e) {
                e.preventDefault();
                markAllNotificationsRead();
            });
        }

        if (notifList) {
            notifList.addEventListener('click', function (e) {
                const button = e.target.closest('.notif-item');
                if (!button) return;
                const id = button.dataset.id;
                if (id) {
                    markSelectedNotificationAsRead(id);
                }
            });
        }

        if (profileBtn) {
            profileBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                profileMenu.classList.toggle('hidden');
                notifMenu.classList.add('hidden');
            });
        }

        document.addEventListener('click', function (e) {
            if (notifMenu && notifBtn && !notifMenu.contains(e.target) && !notifBtn.contains(e.target)) {
                notifMenu.classList.add('hidden');
            }
            if (profileMenu && profileBtn && !profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                profileMenu.classList.add('hidden');
            }
        });

        setInterval(fetchUnreadCount, 15000);
    });
</script>
