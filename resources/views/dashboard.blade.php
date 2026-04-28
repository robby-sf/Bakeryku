@extends('layouts.app')

@section('title', 'Dashboard | Ananda Bakery')

@section('content')
    <div class="py-8 md:py-12">
        <div class="container mx-auto px-4 md:px-6 max-w-4xl">
            
            <div class="mb-8">
                <h1 class="font-heading text-3xl md:text-4xl font-bold text-brand-dark mb-2">Welcome back, {{ Auth::guard('user')->user()->name }}!</h1>
                <p class="text-gray-600">Manage your account and view your recent activity.</p>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-brand-primary text-white p-3 rounded-xl">
                            <i class="fa-solid fa-shopping-cart text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-brand-dark">Orders</h3>
                            <p class="text-sm text-gray-500">View your order history</p>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-brand-primary">0</p>
                    <p class="text-sm text-gray-500">Total orders</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-yellow-500 text-white p-3 rounded-xl">
                            <i class="fa-solid fa-star text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-brand-dark">Reviews</h3>
                            <p class="text-sm text-gray-500">Your product reviews</p>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-yellow-500">{{ Auth::guard('user')->user()->reviews()->count() }}</p>
                    <p class="text-sm text-gray-500">Total reviews</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-green-500 text-white p-3 rounded-xl">
                            <i class="fa-solid fa-heart text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-brand-dark">Favorites</h3>
                            <p class="text-sm text-gray-500">Saved products</p>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-green-500">0</p>
                    <p class="text-sm text-gray-500">Favorite items</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-gray-100">
                <h2 class="font-heading text-2xl font-bold text-brand-dark mb-6">Recent Activity</h2>
                
                <div class="space-y-4">
                    @forelse(Auth::guard('user')->user()->reviews()->latest()->take(5)->get() as $review)
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="bg-yellow-100 text-yellow-600 p-2 rounded-lg">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-brand-dark">You reviewed "{{ $review->product->name }}"</p>
                            <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                            <div class="flex text-yellow-400 text-sm mt-1">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $review->rating)
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <i class="fa-solid fa-inbox text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">No recent activity yet. Start by exploring our menu!</p>
                        <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 bg-brand-primary text-white px-6 py-2 rounded-full font-semibold hover:bg-brand-dark transition mt-4">
                            Browse Menu <i class="fa-solid fa-arrow-right text-sm"></i>
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection