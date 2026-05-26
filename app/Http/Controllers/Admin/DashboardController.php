<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\PageVisit;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfLastMonth = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonthNoOverflow()->endOfMonth();

        $totalProducts = Product::count();
        $totalReviews = Review::count();
        $averageRating = round((float) Review::approved()->avg('rating'), 1);
        $totalVisits = $this->uniqueVisitors();

        $productGrowth = Product::where('created_at', '>=', $startOfMonth)->count();
        $reviewGrowth = Review::where('created_at', '>=', $startOfMonth)->count();
        $visitGrowth = $this->uniqueVisitors(PageVisit::where('created_at', '>=', $startOfMonth));
        $lastMonthVisits = $this->uniqueVisitors(PageVisit::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth]));

        $visitStatus = $this->visitStatus($visitGrowth, $lastMonthVisits);
        $ratingStatus = $this->ratingStatus($averageRating);
        $interactionTrend = $this->interactionTrend();
        $popularProducts = $this->popularProducts();
        $recentActivities = $this->recentActivities();

        return view('Admin.Dashboard.dashboard', compact(
            'totalProducts',
            'totalReviews',
            'averageRating',
            'totalVisits',
            'productGrowth',
            'reviewGrowth',
            'visitGrowth',
            'visitStatus',
            'ratingStatus',
            'interactionTrend',
            'popularProducts',
            'recentActivities'
        ));
    }

    private function visitStatus(int $thisMonth, int $lastMonth): string
    {
        if ($thisMonth === 0) {
            return 'Belum ada kunjungan bulan ini';
        }

        if ($lastMonth === 0) {
            return 'Mulai aktif bulan ini';
        }

        $change = (($thisMonth - $lastMonth) / max($lastMonth, 1)) * 100;

        if ($change >= 10) {
            return '+' . number_format($change, 0) . '% dari bulan lalu';
        }

        if ($change <= -10) {
            return number_format($change, 0) . '% dari bulan lalu';
        }

        return 'Stabil dari bulan lalu';
    }

    private function uniqueVisitors($query = null): int
    {
        $query ??= PageVisit::query();

        return (int) $query->distinct('visitor_id')->count('visitor_id');
    }

    private function ratingStatus(float $rating): string
    {
        return match (true) {
            $rating >= 4.5 => 'Sangat Memuaskan',
            $rating >= 4.0 => 'Memuaskan',
            $rating >= 3.0 => 'Perlu Dipantau',
            $rating > 0 => 'Perlu Ditingkatkan',
            default => 'Belum Ada Rating',
        };
    }

    private function interactionTrend(): Collection
    {
        $weeks = collect(range(3, 0))->map(function (int $weeksAgo) {
            $start = now()->copy()->subWeeks($weeksAgo)->startOfWeek();
            $end = $start->copy()->endOfWeek();

            $visits = $this->uniqueVisitors(PageVisit::whereBetween('created_at', [$start, $end]));
            $reviews = Review::whereBetween('created_at', [$start, $end])->count();
            $favorites = Favorite::whereBetween('created_at', [$start, $end])->count();
            $orders = Order::whereBetween('created_at', [$start, $end])->count();

            return [
                'label' => $weeksAgo === 0 ? 'Minggu Ini' : $start->translatedFormat('d M') . ' - ' . $end->translatedFormat('d M'),
                'total' => $visits + $reviews + $favorites + $orders,
            ];
        });

        $highest = max($weeks->max('total'), 1);

        return $weeks->map(fn (array $week) => [
            ...$week,
            'percent' => (int) round(($week['total'] / $highest) * 100),
        ]);
    }

    private function popularProducts(): Collection
    {
        return Product::query()
            ->leftJoin('page_visits', 'products.id', '=', 'page_visits.product_id')
            ->leftJoin('reviews', function ($join) {
                $join->on('products.id', '=', 'reviews.product_id')
                    ->where('reviews.status', '=', 'approved');
            })
            ->select([
                'products.id',
                'products.name',
                'products.category',
                'products.price',
                'products.image',
                DB::raw('COUNT(DISTINCT page_visits.visitor_id) as visit_count'),
                DB::raw('COALESCE(AVG(reviews.rating), 0) as average_rating'),
            ])
            ->groupBy('products.id', 'products.name', 'products.category', 'products.price', 'products.image')
            ->orderByDesc('visit_count')
            ->orderByDesc('average_rating')
            ->orderBy('products.name')
            ->take(4)
            ->get();
    }

    private function recentActivities(): Collection
    {
        $reviews = Review::with(['user', 'product'])->latest()->take(5)->get()->map(fn (Review $review) => [
            'type' => 'review',
            'color' => '#855333',
            'title' => 'Ulasan baru pada ' . ($review->product?->name ?? 'menu yang dihapus'),
            'description' => ($review->user?->name ?? 'Pelanggan') . ' memberi rating ' . $review->rating . ' bintang',
            'date' => $review->created_at,
        ]);

        $users = User::where('role', 'user')->latest()->take(5)->get()->map(fn (User $user) => [
            'type' => 'user',
            'color' => '#BA8E60',
            'title' => 'Pengguna baru mendaftar',
            'description' => $user->name . ' bergabung sebagai pelanggan',
            'date' => $user->created_at,
        ]);

        $products = Product::latest('updated_at')->take(5)->get()->map(fn (Product $product) => [
            'type' => 'product',
            'color' => '#3B82F6',
            'title' => $product->created_at?->equalTo($product->updated_at) ? 'Menu baru ditambahkan' : 'Katalog menu diperbarui',
            'description' => $product->name,
            'date' => $product->updated_at,
        ]);

        $orders = Order::with(['user', 'product'])->latest()->take(5)->get()->map(fn (Order $order) => [
            'type' => 'order',
            'color' => '#16A34A',
            'title' => 'Pesanan WhatsApp dibuat',
            'description' => ($order->user?->name ?? 'Pelanggan') . ' memesan ' . ($order->product?->name ?? 'menu yang dihapus'),
            'date' => $order->created_at,
        ]);

        return collect($reviews)
            ->merge($users)
            ->merge($products)
            ->merge($orders)
            ->sortByDesc(fn (array $activity) => $activity['date'] instanceof Carbon ? $activity['date']->timestamp : 0)
            ->take(5)
            ->values();
    }
}
