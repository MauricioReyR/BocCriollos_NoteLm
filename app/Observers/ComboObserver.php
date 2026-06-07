<?php

namespace App\Observers;

use App\Http\Controllers\HomeController;
use App\Models\Combo;

class ComboObserver
{
    /**
     * Handle the Combo "created" event.
     */
    public function created(Combo $combo): void
    {
        HomeController::flushCache();
    }

    /**
     * Handle the Combo "updated" event.
     */
    public function updated(Combo $combo): void
    {
        HomeController::flushCache();
    }

    /**
     * Handle the Combo "deleted" event.
     */
    public function deleted(Combo $combo): void
    {
        HomeController::flushCache();
    }

    /**
     * Handle the Combo "restored" event.
     */
    public function restored(Combo $combo): void
    {
        HomeController::flushCache();
    }

    /**
     * Handle the Combo "force deleted" event.
     */
    public function forceDeleted(Combo $combo): void
    {
        HomeController::flushCache();
    }
}
