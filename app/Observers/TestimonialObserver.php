<?php

namespace App\Observers;

use App\Http\Controllers\HomeController;
use App\Models\Testimonial;

class TestimonialObserver
{
    /**
     * Handle the Testimonial "created" event.
     */
    public function created(Testimonial $testimonial): void
    {
        HomeController::flushCache();
    }

    /**
     * Handle the Testimonial "updated" event.
     */
    public function updated(Testimonial $testimonial): void
    {
        HomeController::flushCache();
    }

    /**
     * Handle the Testimonial "deleted" event.
     */
    public function deleted(Testimonial $testimonial): void
    {
        HomeController::flushCache();
    }

    /**
     * Handle the Testimonial "restored" event.
     */
    public function restored(Testimonial $testimonial): void
    {
        HomeController::flushCache();
    }

    /**
     * Handle the Testimonial "force deleted" event.
     */
    public function forceDeleted(Testimonial $testimonial): void
    {
        HomeController::flushCache();
    }
}
