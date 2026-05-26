<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use App\Models\Product;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrackPageVisit
{
    private const VISITOR_COOKIE = 'bakeryku_visitor_id';

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            $product = $request->route('product');
            $cookieVisitorId = $request->cookie(self::VISITOR_COOKIE) ?: (string) Str::uuid();
            $visitorId = auth()->guard('user')->check()
                ? 'user-' . auth()->guard('user')->id()
                : 'guest-' . $cookieVisitorId;

            try {
                PageVisit::create([
                    'user_id' => auth()->guard('user')->id(),
                    'product_id' => $product instanceof Product ? $product->id : null,
                    'visitor_id' => $visitorId,
                    'path' => '/' . ltrim($request->path(), '/'),
                    'route_name' => $request->route()?->getName(),
                    'ip_address' => $request->ip(),
                    'user_agent' => substr((string) $request->userAgent(), 0, 512),
                    'visit_date' => now()->toDateString(),
                ]);
            } catch (Throwable $exception) {
                report($exception);
            }

            if (! $request->cookie(self::VISITOR_COOKIE)) {
                $response->headers->setCookie(cookie(
                    self::VISITOR_COOKIE,
                    $cookieVisitorId,
                    60 * 24 * 365,
                    '/',
                    null,
                    $request->isSecure(),
                    true,
                    false,
                    'Lax'
                ));
            }
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        return $request->isMethod('GET')
            && ! app()->runningUnitTests()
            && $response->isSuccessful()
            && ! $request->ajax()
            && ! $request->expectsJson()
            && ! $request->is('admin*')
            && ! $request->is('login')
            && ! $request->is('register')
            && ! str_starts_with((string) $request->route()?->getName(), 'admin.');
    }
}
