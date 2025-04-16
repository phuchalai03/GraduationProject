<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\DestinationController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\TourController;
use App\Http\Controllers\User\TourGuideController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/redirect', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.home');
        }
        return redirect()->route('home.index');
    })->name('redirect');

    // Trang admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
    });

    // Trang user
    Route::middleware('role:user')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home.index');
        Route::get('/about', [AboutController::class, 'index'])->name('about.index');
        Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
        Route::get('/destination', [DestinationController::class, 'index'])->name('destination.index');
        Route::get('/tour', [TourController::class, 'index'])->name('tour.index');
        Route::get('/tour_guide', [TourGuideController::class, 'index'])->name('tour_guide.index');
        Route::get('/tour_detail/{id}', [TourController::class, 'tour_detail'])->name('tour_detail');
    });
});

require __DIR__.'/auth.php';
