<?php

use App\Http\Controllers\AdminComboController;
use App\Http\Controllers\AdminTestimonialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestimonialController;
use App\Models\Combo;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::post('/testimonios', [TestimonialController::class, 'store'])->middleware('throttle:3,1');

Route::get('/testimonios/aprobar/{testimonial}/{token}', [TestimonialController::class, 'approve'])
    ->name('testimonios.aprobar');

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminTestimonialController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/', [AdminTestimonialController::class, 'login'])->middleware('throttle:5,1');
    Route::post('/logout', [AdminTestimonialController::class, 'logout'])->name('admin.logout');

    Route::middleware('admin')->group(function () {
        // Testimonios
        Route::get('/testimonios', [AdminTestimonialController::class, 'index'])->name('admin.testimonios');
        Route::get('/testimonios/{testimonial}/edit', [AdminTestimonialController::class, 'edit'])->name('admin.testimonios.edit');
        Route::put('/testimonios/{testimonial}', [AdminTestimonialController::class, 'update'])->name('admin.testimonios.update');
        Route::delete('/testimonios/{testimonial}', [AdminTestimonialController::class, 'destroy'])->name('admin.testimonios.destroy');
        Route::post('/testimonios/{testimonial}/approve', [AdminTestimonialController::class, 'approve'])->name('admin.testimonios.approve');

        // Combos
        Route::get('/combos', [AdminComboController::class, 'index'])->name('admin.combos');
        Route::get('/combos/{combo}/edit', [AdminComboController::class, 'edit'])->name('admin.combos.edit');
        Route::put('/combos/{combo}', [AdminComboController::class, 'update'])->name('admin.combos.update');
        Route::delete('/combos/{combo}', [AdminComboController::class, 'destroy'])->name('admin.combos.destroy');
        Route::patch('/combos/{combo}/toggle-active', [AdminComboController::class, 'toggleActive'])->name('admin.combos.toggle-active');
    });
});

/*
|--------------------------------------------------------------------------
| Sitemap Dinámico
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', function () {
    $lastmod = Cache::remember('bocaditos.sitemap.lastmod', 3600, function () {
        $latestCombo = Combo::query()->latest('updated_at')->value('updated_at');
        $latestTestimonial = Testimonial::query()->latest('updated_at')->value('updated_at');

        $dates = array_filter([$latestCombo, $latestTestimonial]);

        return $dates ? max($dates)->format('Y-m-d') : now()->format('Y-m-d');
    });

    return response()->view('sitemap', [
        'lastmod' => $lastmod,
        'url' => url('/'),
    ])->header('Content-Type', 'application/xml');
});
