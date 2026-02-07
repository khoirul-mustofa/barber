<?php

namespace App\Providers;

use App\Models\Booking;
use App\Observers\BookingObserver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
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
        // if (! function_exists('setting')) {
        //     Log::warning('Helper function "setting" is not defined. Please check if app/helpers.php is loaded.');
        // }
        Booking::observe(BookingObserver::class);

        // if (app()->environment('production')) {
        //     URL::forceScheme('https');
        // }
    }
}
