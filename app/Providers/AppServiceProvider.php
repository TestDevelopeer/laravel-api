<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api_limiter', static function (Request $request) {
            return Limit::perMinute(30)->by(optional($request->user())->id ?: $request->ip())
                ->response(function (Request $request, array $headers) {
                    return response([
                        'message' => 'Limit exceeded'
                    ], 429);
                });
        });
    }
}
