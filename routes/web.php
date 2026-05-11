<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
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
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', function () {return view('landing_page');})->name('landing_page');
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
Route::get('/stores', function () {return view('Store.store');})->name('store');
Route::get('/promo', function () {return view('Promo.promo');})->name('promo');
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
    Route::get('/', function () {
        $totalProducts = Product::count();
        $totalReviews = Review::count();
        $averageRating = Review::avg('rating') ? round(Review::avg('rating'), 1) : 0;

        return view('Admin.Dashboard.dashboard', compact('totalProducts', 'totalReviews', 'averageRating'));
    })->name('dashboard');

    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    });
    
    // Product CRUD routes
    Route::resource('products', ProductController::class);
    
    // Admin review routes
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{review}', [AdminReviewController::class, 'show'])->name('reviews.show');
    Route::post('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('/reviews/{review}/reject', [AdminReviewController::class, 'reject'])->name('reviews.reject');
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
    Route::get('/activities', function () {return view('Admin.Activities.activities');})->name('activities');
    
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
