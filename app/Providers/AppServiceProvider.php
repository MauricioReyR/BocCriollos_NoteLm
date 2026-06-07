<?php

namespace App\Providers;

use App\Models\Combo;
use App\Models\Testimonial;
use App\Observers\ComboObserver;
use App\Observers\TestimonialObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Load custom helpers
        require_once app_path('Helpers/helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Combo::observe(ComboObserver::class);
        Testimonial::observe(TestimonialObserver::class);
    }
}
