<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', function () {
    try {
        $promos = Promo::active()->latest()->take(3)->get();
    } catch (\Throwable $e) {
        $promos = collect();
    }

    $settings = Cache::get('app_settings', []);
    $waNumber = $settings['wa_number'] ?? '+62 856 0238 5989';

    // Hero products: top 5 highest-rated products with images
    try {
        $heroProducts = Product::where('status', 'Tersedia')
            ->whereNotNull('image')
            ->withCount(['reviews as published_reviews_count' => function ($q) {
                $q->where('status', 'published');
            }])
            ->withAvg(['reviews as published_reviews_avg' => function ($q) {
                $q->where('status', 'published');
            }], 'rating')
            ->orderByDesc('published_reviews_avg')
            ->orderByDesc('published_reviews_count')
            ->take(5)
            ->get();
    } catch (\Throwable $e) {
        $heroProducts = collect();
    }

    // Featured menu: top 6 highest-rated available products
    try {
        $featuredProducts = Product::where('status', 'Tersedia')
            ->withCount(['reviews as published_reviews_count' => function ($q) {
                $q->where('status', 'published');
            }])
            ->withAvg(['reviews as published_reviews_avg' => function ($q) {
                $q->where('status', 'published');
            }], 'rating')
            ->orderByDesc('published_reviews_avg')
            ->orderByDesc('published_reviews_count')
            ->take(6)
            ->get();
    } catch (\Throwable $e) {
        $featuredProducts = collect();
    }

    // Curated reviews: high-rated approved reviews from various products
    try {
        $reviews = \App\Models\Review::where('status', 'published')
            ->whereIn('rating', [4, 5])
            ->with(['user', 'product'])
            ->inRandomOrder()
            ->take(8)
            ->get();
    } catch (\Throwable $e) {
        $reviews = collect();
    }

    return view('landing_page', compact('promos', 'waNumber', 'heroProducts', 'featuredProducts', 'reviews'));
})->name('landing_page');
Route::get('/menu', function () {
    $products = Product::where('status', 'Tersedia')->get();
    $categories = collect(['Pastry', 'Bread', 'Cakes', 'Chocolate', 'Assorted']);
    $categoryMap = [
        'pastry' => ['Pastry'],
        'bread' => ['Roti Manis', 'Roti Asin', 'Bread'],
        'cakes' => ['Cakes'],
        'chocolate' => ['Chocolate'],
        'assorted' => ['Assorted'],
    ];
    return view('Menu.menu_list', compact('products', 'categories', 'categoryMap'));
})->name('menu');
Route::get('/stores', function () {
    try {
        $products = Product::where('status', 'Tersedia')
            ->whereNotNull('image')
            ->inRandomOrder()
            ->take(5)
            ->get();
    } catch (\Throwable $e) {
        $products = collect();
    }
    return view('Store.store', compact('products'));
})->name('store');
Route::get('/promo', function () {
    try {
        $promos = Promo::active()->latest()->get();
    } catch (\Throwable $e) {
        $promos = collect();
    }

    $settings = Cache::get('app_settings', []);
    $waNumber = $settings['wa_number'] ?? '+62 856 0238 5989';

    return view('Promo.promo', compact('promos', 'waNumber'));
})->name('promo');
Route::get('/menu/view/{product}', [\App\Http\Controllers\MenuController::class, 'show'])->name('menu_view');

// Admin authentication
Route::prefix('admin/auth')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register.post');
    Route::match(['GET', 'POST'], '/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Normal user authentication - allow non-user roles (admins) to access login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


Route::match(['GET', 'POST'], '/logout', [AuthController::class, 'logout'])->name('logout');

// User-only routes (requires authentication and user role)
Route::middleware(['user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/reviews/product/{product}', [ReviewController::class, 'getProductReviews'])->name('reviews.product');
    
    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [NotificationController::class, 'recent'])->name('notifications.recent');

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/whatsapp', [OrderController::class, 'store'])->name('orders.whatsapp');
});

// Admin protected routes (requires auth+admin role)
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    });
    
    // Product CRUD routes
    Route::resource('products', ProductController::class);
    
    // Admin review routes
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{review}', [AdminReviewController::class, 'show'])->name('reviews.show');
    Route::post('/reviews/{review}/hide', [AdminReviewController::class, 'hide'])->name('reviews.hide');
    Route::post('/reviews/{review}/unhide', [AdminReviewController::class, 'unhide'])->name('reviews.unhide');
    Route::post('/reviews/{review}/respond', [AdminReviewController::class, 'respond'])->name('reviews.respond');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
    
    // Settings routes
    Route::get('/settings', [SettingsController::class, 'show'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    
    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/{notification}/read', [AdminNotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [AdminNotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::get('/notifications/unread-count', [AdminNotificationController::class, 'unreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [AdminNotificationController::class, 'recent'])->name('notifications.recent');
    Route::get('/activities', function () {
        $type = request('type', 'all');
        $query = \App\Models\ActivityLog::with('user')->latest();

        if ($type !== 'all') {
            $query->where('type', $type);
        }

        $activities = $query->paginate(10)->withQueryString();
        return view('Admin.Activities.activities', compact('activities', 'type'));
    })->name('activities');

    Route::get('/activities/export', function () {
        $type = request('type', 'all');
        $query = \App\Models\ActivityLog::with('user')->latest();

        if ($type !== 'all') {
            $query->where('type', $type);
        }

        $logs = $query->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="log_aktivitas_' . $type . '_' . date('Ymd_His') . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($logs) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for Excel UTF-8 compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // CSV Header
            fputcsv($file, ['ID', 'Tanggal', 'Pengguna', 'Tipe', 'Judul', 'Deskripsi']);

            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->created_at->format('Y-m-d H:i:s') . ' WIB',
                    $log->user ? $log->user->name . ' (' . $log->user->email . ')' : 'System / Guest',
                    ucfirst($log->type),
                    $log->title,
                    $log->description
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    })->name('activities.export');
    
    // Promo CRUD routes
    Route::get('/promos', [PromoController::class, 'index'])->name('promos');
    Route::get('/promos/add', [PromoController::class, 'create'])->name('promos.add');
    Route::post('/promos', [PromoController::class, 'store'])->name('promos.store');
    Route::get('/promos/{promo}/edit', [PromoController::class, 'edit'])->name('promos.edit');
    Route::put('/promos/{promo}', [PromoController::class, 'update'])->name('promos.update');
    Route::delete('/promos/{promo}', [PromoController::class, 'destroy'])->name('promos.destroy');
    
    // Profile routes
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile');
    Route::post('/profile/update', [AdminProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
});
